import re
import secrets
import random
import itertools
import os
import receiver
import config as cfg
import utils
import pickle
from queue import Queue
from threading import Thread, Lock
from executor import Executor 
import errreader as err

fix_prompt = "The response did not correspond to the ```<code>``` format."
mix_prompt = "The response did not correspond to the ```<code>``` ```<code>``` ```<code>```format." 
min_prompt = "Reduce the amount of tokens in this code. Return as ```<code>```"
seed_data_lock = Lock()

GEN_NUM = 0

def correct_format(llm, result, context):
    result = [line + "\n" for line in result.split("\n")]
    #if result[0].strip() == "error":
    #    raise RuntimeError("Restarting LLM")
    i = 0
    code = ""
    while i < 2:
        i += 1
        code_section = False
        for line in result:
            if "```" in line and not(code_section):
                code_section = True
            elif "```" in line and code_section:
                break
            elif code_section:
                code += line
        if code == "":
            print("\n! Re-query: Format Error !\n")
            context.append({'role': 'user', 'content': fix_prompt})
            result = llm.give_context(context)
        else:
            break
    try:
        if "<?php" not in code.split("\n")[0]:
            code = "<?php\n" + code + "\n?>"
    except Exception as e:
        print("ERRRORRRRRR")
        print(code)
        quit()
    return code

def generate_fix_prompt(code, error):
    role = 'Fix PHP code. Return as ```<code>```'
    context = [{'role': 'system', 'content': role}]
    prompt = ""
    prompt += "```\n{c}\n```\n".format(c=code)
    prompt += error
    context.append({'role': 'user', 'content': prompt})
    return context

def mate(male, female):
    role = "Mix PHP code. Return as ```<code>```"
    context = [{'role':'system','content':role}]
    prompt = "Here is Code A:\n```"
    prompt += male + "\n```"
    prompt += "Here is Code B:\n```"
    prompt += female + "\n```"
    prompt += "\nMix Code A and Code B together. Do not simply append B to A. Return as ```<code>```"
    #prompt += "Use Code B in Code A. Do not simply append B to A." ?
    context.append({'role':'user','content':prompt})
    return context

def minimize(seed):
    print("minimize this")

def update_data(iteration, llm_queue, cov_queue):
    if iteration == 20:
        utils.dump_pickle(cfg.llm_queue, list(llm_queue.queue))
        utils.dump_pickle(cfg.cov_queue, list(cov_queue.queue))
        return 0
    else:
        return iteration + 1

def create_seed_data(seed_data, seed_name, php_file):
    with seed_data_lock:
        if seed_name not in seed_data:
            seed_data[seed_name] = {
                    "reset_count": 0,
                    "fix_count": 0,
                    "php_file": php_file,
                    "context": None,
                    "coverage": 0, #coverage is relative to the base map
                    "parents": None, #we don't want inbreeding
                    }

def query_loop(seed_data, llm_queue, cov_queue):
    role = 'You are a chatting assistant'
    context = [{'role': 'system', 'content': role}]
    llm = receiver.LLAMA3_LLM(context)

    i = 0
    while(True):
        request_file = llm_queue.get() # blocking function
        seed_name = request_file.split("/")[-1].split("_")[0]
        php_file = os.path.join(cfg.php_corpus,
                request_file.split("/")[-1].split("_")[0]+".php")
        create_seed_data(seed_data, seed_name, php_file)
        if("_t" in request_file): 
            print("Translating: {}".format(request_file))
            context = utils.load_pickle(request_file)
            os.remove(request_file)
            result = llm.give_context(context)
            context.append({'role':'assistant','content':result})
            code = correct_format(llm, result, context)
            utils.write_file(php_file, code)
            cov_queue.put(php_file)
        elif("_m" in request_file): #Mate request
            print("Mating: {}".format(request_file))
            context = utils.load_pickle(request_file)
            os.remove(request_file)
            result = llm.give_context(context)
            context.append({'role':'assistant','content':result})
            child = correct_format(llm, result, context)
            dr = "gen_" + str(GEN_NUM)
            name = secrets.token_hex(10);
            php0 = os.path.join(dr,name+".php")
            create_seed_data(seed_data, name, php0); utils.write_file(php0,child)
            seed_data[name]['parents']=seed_data[seed_name]['parents']
            cov_queue.put(php0); #cov_queue.put(php1); #cov_queue.put(php2)
            del(seed_data[seed_name])
            quit()
        elif("_f" in request_file): #Fix request
            print("Fixing: {}".format(request_file))
            if seed_data[seed_name]['fix_count'] == 5:
                os.remove(request_file)
                print("Nah, can't fix this one")
                if 'corpus' not in php_file: #this indicates either the original js/php corpi
                    os.remove(php_file)
            else:
                context = utils.load_pickle(request_file)
                seed_data[seed_name]['fix_count'] += 1
                os.remove(request_file)
                #Maybe make this an inherent feature of queries
                if utils.num_tokens_from_context(context) > cfg.llama3_max / 2:
                    print("trying to fix.... too big")
                else:
                    result = llm.give_context(context)
                    context.append({'role':'assistant','content':result})
                    code = correct_format(llm, result, context)
                    utils.write_file(php_file, code)
                    cov_queue.put(php_file)
        i = update_data(i, llm_queue, cov_queue)

def coverage_loop(seed_data, llm_queue, cov_queue):
    cov_eng = Executor(cfg.coverage_engine)
    while(True):
        if cov_queue.qsize() == 0 and llm_queue.qsize() == 0:
            next_gen(seed_data, llm_queue, cov_queue)
        else:
            php_file = cov_queue.get()
            print("mapping: ", php_file)
            cov_eng.load_global_coverage_map_from_file(cfg.base_map)
            code = utils.read_file(php_file)
            result = cov_eng.execute_prog(php_file)
            if result == -1:
                print("Bad execution")
                continue
            if err.is_error(result):
                fix_query = generate_fix_prompt(code, err.parse_error(result, php_file))
                fix_req_name = os.path.join(cfg.llm_requests,
                                            php_file.split("/")[-1].split(".")[0]+"_f")
                utils.dump_pickle(fix_req_name, fix_query)
                llm_queue.put(fix_req_name)
            else:
                utils.add_to_queue(cfg.san_queue,php_file)
                coverage = cov_eng.read()
                seed_name = php_file.split("/")[-1].split(".")[0]
                seed_data[seed_name]['coverage'] = coverage

def next_gen(seed_data, llm_queue, cov_queue):
    global GEN_NUM
    pairs = []
    print("Creating new generation")
    if GEN_NUM == 0:
        generation = os.listdir('gen_0')
        male_group = generation[:len(generation)//2]
        female_group = generation[len(generation)//2:]
        for m in male_group:
            f = female_group[random.randint(0,len(female_group)-1)]
            female_group.remove(f)
            pairs.append((m,f))
        female_group = generation[len(generation)//2:]
        for m in male_group:
            f = female_group[random.randint(0,len(female_group)-1)]
            if (m,f) in pairs:
                f = female_group[random.randint(0,len(female_group)-1)]
            pairs.append((m,f))
    else:
        print("yeah i'm done")
        os._exit(1)
        directory = 'gen_'+str(GEN_NUM)
        generation = os.listdir(directory)
        male_group = generation[:len(generation)//2]
        female_group = generation[len(generation)//2:]
        for m in male_group:
            m_name = m.split(".")[0]
            f = female_group[random.randint(0,len(female_group)-1)]
            f_name = f.split(".")[0]
            for parent in seed_data[m_name]['parents']:
                while parent in seed_data[f_name]['parents']:
                    f = female_group[random.randint(0,len(female_group)-1)]
                    f_name = f.split(".")[0]
            female_group.remove(f)
            pairs.append((m,f))
        female_group = generation[len(generation)//2:]
        for m in male_group:
            m_name = m.split(".")[0]
            f = female_group[random.randint(0,len(female_group)-1)]
            f_name = f.split(".")[0]
            for parent in seed_data[m_name]['parents']:
                while parent in seed_data[f_name]['parents']:
                    f = female_group[random.randint(0,len(female_group)-1)]
                    f_name = f.split(".")[0]
            female_group.remove(f)
            pairs.append((m,f))

    GEN_NUM += 1
    new_dir = "gen_" + str(GEN_NUM)
    os.makedirs(new_dir)
    for pair in pairs:
        tmp_seed_name = secrets.token_hex(10)
        #php_file = os.path.join(new_dir,seed_name + ".php")
        create_seed_data(seed_data, tmp_seed_name, None)
        seed_data[tmp_seed_name]['parents'] = pair
        prev_gen_dir = 'gen_' + str(GEN_NUM-1)
        with open(os.path.join(prev_gen_dir,pair[0]),'r') as f:
            female = f.read()
        with open(os.path.join(prev_gen_dir,pair[1]),'r') as m:
            male = m.read()
        mate_query = mate(male,female)
        mate_req_name = os.path.join(cfg.llm_requests,
                                     tmp_seed_name + "_m")
        utils.dump_pickle(mate_req_name, mate_query)
        llm_queue.put(mate_req_name)

def main():
    seed_data = utils.load_pickle(cfg.seed_data)

    llm_queue = Queue()
    for i in utils.load_pickle(cfg.llm_queue):
        llm_queue.put(i)
    cov_queue = Queue()
    for i in utils.load_pickle(cfg.cov_queue):
        cov_queue.put(i)

    query_thread = Thread(target=query_loop, args=(seed_data, llm_queue, cov_queue))
    coverage_thread = Thread(target=coverage_loop, args=(seed_data, llm_queue, cov_queue))
    query_thread.start()
    coverage_thread.start()
    query_thread.join()
    coverage_thread.join()

if __name__ == "__main__":
    main()
