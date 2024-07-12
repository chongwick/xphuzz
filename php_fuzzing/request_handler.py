import time
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
from aljamain_sterling import pairing_aljo, new_aljo
from grammar_generators.php_gen import generate_samples
import san

fix_prompt = "The response did not follow the ```<code>``` format."
min_prompt = "Reduce the amount of tokens in this code. Return as ```<code>```"
seed_data_lock = Lock()

tmp = []
for i in os.listdir(os.getcwd()):
    if "gen_" in i:
        tmp.append(int(i.split("_")[1]))    
GEN_NUM = max(tmp) #Current generation
TOKEN_LIMIT = 3900 #Given that the context window is 8000 for our LLM,
                   #our cutoff will be 3900 tokens.
del(tmp)

def query_llm(llm, context):
    result = llm.give_context(context)
    if result == "-1" or result == "-2":
        result = llm.give_context(context)
        if result == "-1" or result == "-2":
            return -1
    else:
        return result

def correct_format(llm, result, context):
    if type(result) != str:
        return None
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
            del(result)
            result = query_llm(llm, context)
            if type(result) != str:
                return None
        else:
            break
    if "<?php" not in code.split("\n")[0]:
        code = "<?php\n" + code + "\n?>"

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

def mutation_insertion(code):
    role = "You are a randomized PHP code modifier. Return as ```<code>```"
    context = [{'role':'system','content':role}]
    line = generate_samples(os.path.dirname(__file__),None,"<phpfuzz>",1,"no_guard_php.txt")
    prompt = "Here is CODE:\n```{c}\n```\nHere is LINE:\n```{l}\n```\nUse LINE\
            to modify CODE.".format(c=code,l=line)
    context.append({'role':'user','content':prompt})
    return context

def minimize(seed):
    role = "You are a token reducer. Return as ```<code>```"
    context = [{'role':'system','content':role}]
    prompt = "```{}```\nReduce the amount of tokens while maintaining functionality".format(
            seed)
    context.append({'role':'user','content':prompt})
    return context

def new_corpus(llm, iterations, out_dir):
    global GEN_NUM
    #i = 0
    while len(os.listdir(out_dir)) != iterations:
    #while i < iterations:
        role = 'Change PHP code as instructed. Here are some values to use: 0, 1, -1, 2, 3, 4, 5, 10, 100, 100000, 5473817451, 123475932, 2.23431234213480e-400. Return as ```<code>```'
        context = [{'role': 'system', 'content': role}]
        #llm = LLAMA3_LLM(context)
        #print("llm loaded")
        code = '$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), 257), str_repeat(chr(193), 257) + str_repeat(chr(155), 17) + str_repeat(chr(147), 4097), str_repeat(chr(161), 65537) + str_repeat(chr(213), 1025) + str_repeat(chr(214), 1025));'
        prompt = 'Use this code in a complex PHP script:\n```\n{}\n```'.format(code)
        context.append({'role':'user','content':code})
        response = '```code\n<?php\n$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), 257),\nbin2hex(str_repeat(chr(193), 257). str_repeat(chr(155), 17). str_repeat(chr(147), 4097)),\nbin2hex(str_repeat(chr(161), 65537). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025)));\n?>\n```'
        context.append({'role':'assistant','content':response})
        #new_code = 'passthru(implode(array_map(function($c) {return "\\x" . str_pad(deche    x($c), 2, "0");}, range(0, 255))), $ref_int);'
        new_code = generate_samples(
                os.path.dirname(__file__),None,"<phpfuzz>",1,"no_guard_php.txt")
        context.append({'role':'user','content':'Make this unexpected, weird, and potentially incorrect:\n```\n{}\n```'.format(new_code)})
        result = query_llm(llm,context)
        context.append({'role':'assistant','content':result})
        code = correct_format(llm, result, context)
        if code == None: #Idk some weird error that idc about
            continue
        mut_name = str(GEN_NUM+1)+"_b_"+secrets.token_hex(10);
        with open(os.path.join(out_dir,mut_name),"w") as f:
            f.write(code)
    #    i += 1

def update_data(llm_queue, cov_queue, seed_data):
    utils.dump_pickle(cfg.llm_queue, list(llm_queue.queue))
    utils.dump_pickle(cfg.cov_queue, list(cov_queue.queue))
    utils.dump_pickle(cfg.seed_data, seed_data)

def room_service(safe_files):
    dir_path = os.path.dirname(os.path.realpath(__file__))
    cur_files = os.listdir(dir_path)
    for i in cur_files:
        if i not in safe_files and (
                "gen_" not in i) and (
                        "blank.php" not in i) and (
                            "boot_" not in i):
            os.remove(os.path.join(dir_path,i))

def create_seed_data(seed_data, seed_name, php_file):
    with seed_data_lock:
        if seed_name not in seed_data:
            seed_data[seed_name] = {
                    "reset_count": 0,
                    "fix_count": 0,
                    "php_file": php_file,
                    "context": None,
                    "parents": None, #we don't want inbreeding !!!Parents should be a set!!!
                    "time": 0,
                    "solo_cov": None,
                    "new_cov": None,
                    "size": None, #AKA token length
                    "crash": None, #AKA token length
                    "generation": GEN_NUM
                    #"score":0, #The score will be updated after every generation
                    }

def query_loop(llm, seed_data, llm_queue, cov_queue):
    global GEN_NUM
    while(True):
        request_file = llm_queue.get() # blocking function
        seed_name = request_file.split("/")[-1].split("_")[0]
        php_file = os.path.join(cfg.php_corpus,
                request_file.split("/")[-1].split("_")[0]+".php")
        create_seed_data(seed_data, seed_name, php_file)
        if("_t" in request_file): 
            start = time.time()
            print("Translating: {}".format(request_file))
            context = utils.load_pickle(request_file)
            os.remove(request_file)
            result = query_llm(llm,context)
            context.append({'role':'assistant','content':result})
            code = correct_format(llm, result, context)
            if code == None:
                seed_data[seed_name]['fix_count'] = 5
                update_data(llm_queue, cov_queue, seed_data)
                continue
            utils.write_file(php_file, code)
            seed_data[seed_name]['php_file'] = php_file
            seed_data[seed_name]['time'] += time.time() - start
            cov_queue.put(php_file)
        elif("_m" in request_file): #Mate request
            start = time.time()
            tmp_seed_name = seed_name
            print("Mating: {}".format(request_file))
            context = utils.load_pickle(request_file)
            os.remove(request_file)
            result = query_llm(llm,context)
            context.append({'role':'assistant','content':result})
            child = correct_format(llm, result, context)
            if child == None:
                seed_data[seed_name]['fix_count'] = 5
                update_data(llm_queue, cov_queue, seed_data)
                continue
            #print("Inserting Mutation")
            #result = query_llm(llm,mutation_insertion(child))
            #context.append({'role':'assistant','content':result})
            #child = correct_format(llm, result, context)
            dr = "gen_" + str(GEN_NUM)
            seed_name = secrets.token_hex(10);
            php_file = os.path.join(dr,seed_name+".php")
            create_seed_data(seed_data, seed_name, php_file)
            utils.write_file(php_file,child)
            seed_data[seed_name]['parents']=seed_data[tmp_seed_name]['parents']
            seed_data[seed_name]['time'] += time.time() - start
            cov_queue.put(php_file); #cov_queue.put(php1); #cov_queue.put(php2)
            del(seed_data[tmp_seed_name])
        elif("_f" in request_file): #Fix request
            start = time.time()
            print("Fixing: {}".format(request_file))
            if seed_data[seed_name]['fix_count'] >= 5:
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
                    print("trying to fix... too big")
                else:
                    result = query_llm(llm,context)
                    context.append({'role':'assistant','content':result})
                    code = correct_format(llm, result, context)
                    if code == None:
                        seed_data[seed_name]['fix_count'] = 5
                        update_data(llm_queue, cov_queue, seed_data)
                        continue
                    utils.write_file(php_file, code)
                    cov_queue.put(php_file)
                    seed_data[seed_name]['time'] += time.time() - start
        update_data(llm_queue, cov_queue, seed_data)

def coverage_loop(seed_data, llm_queue, cov_queue, san_queue):
    safe_files = os.listdir(os.path.dirname(os.path.realpath(__file__)))  
    cov_eng = Executor(cfg.coverage_engine)
    while(True):
        if cov_queue.qsize() == 0 and san_queue.qsize() == 0 and cov_queue.qsize() == 0:
            next_gen(seed_data, llm_queue, cov_queue)
        else:
            php_file = cov_queue.get()
            print("mapping: ", php_file)
            cov_eng.load_global_coverage_map_from_file(cfg.base_map)
            code = utils.read_file(php_file)
            og = code
            with open(cfg.php_template,"r") as f:
                template = f.read()
            code = code.replace("<?php",template)
            utils.write_file(php_file,code)
            result = cov_eng.execute_prog(php_file)

            if result == -1:
                print("Bad execution")
                utils.write_file(php_file,og)
                continue
            if err.is_error(result):
                fix_query = generate_fix_prompt(code, err.parse_error(result, php_file))
                fix_req_name = os.path.join(cfg.llm_requests,
                                            php_file.split("/")[-1].split(".")[0]+"_f")
                utils.dump_pickle(fix_req_name, fix_query)
                llm_queue.put(fix_req_name)
            else:
                san_queue.put(php_file)
                coverage = cov_eng.read()
                seed_name = php_file.split("/")[-1].split(".")[0]
                seed_data[seed_name]['solo_cov'] = coverage
                #Get the collective coverage
                cov_eng.load_global_coverage_map_from_file(cfg.collective_map)
                cur_cov = cov_eng.read()
                cov_eng.execute_prog(php_file)
                increase = cov_eng.read() - cur_cov
                cov_eng.save_global_coverage_map_in_file(cfg.collective_map)
                seed_data[seed_name]['new_cov'] = increase
            utils.write_file(php_file,og)
            update_data(llm_queue, cov_queue, seed_data)
            room_service(safe_files)

def next_gen(seed_data, llm_queue, cov_queue):
    global GEN_NUM
    tmp = {}
    for i in os.listdir("gen_" + str(GEN_NUM)):
        name = i.split(".")[0]
        tmp[name] = seed_data[name]
    partitions = san.scoring_function(tmp)
    pairs = new_aljo(GEN_NUM,partitions)
    GEN_NUM+=1
    new_dir = "gen_" + str(GEN_NUM)
    os.makedirs(new_dir)
    boot_gen = "boot_"+str(GEN_NUM)
    for pair in pairs:
        tmp_seed_name = secrets.token_hex(10) #This temporary seed will hold parent data
        #php_file = os.path.join(new_dir,seed_name + ".php")
        create_seed_data(seed_data, tmp_seed_name, None)
        seed_data[tmp_seed_name]['parents'] = set(pair)
        prev_gen_dir = 'gen_' + str(GEN_NUM-1)
        with open(seed_data[pair[0]]['php_file'],'r') as m:
        #with open(os.path.join(prev_gen_dir,pair[0]+".php"),'r') as m:
            male = m.read()
        female = None
        if "_b_" in pair[1]:
            with open(os.path.join(boot_gen,pair[1]),'r') as f:
                female = f.read()
        else:
            with open(seed_data[pair[1]]['php_file'],'r') as f:
                  female = f.read()
        #    with open(os.path.join(prev_gen_dir,pair[1]+".php"),'r') as f:
        #        female = f.read()
        mate_query = mate(male,female)
        mate_req_name = os.path.join(cfg.llm_requests,
                                     tmp_seed_name + "_m")
        utils.dump_pickle(mate_req_name, mate_query)
        llm_queue.put(mate_req_name)

def main():
    seed_data = utils.load_pickle(cfg.seed_data)

    role = 'You are a chatting assistant'
    context = [{'role': 'system', 'content': role}]
    llm = receiver.LLAMA3_LLM(context)

    llm_queue = Queue()
    for i in utils.load_pickle(cfg.llm_queue):
        llm_queue.put(i)
    cov_queue = Queue()
    for i in utils.load_pickle(cfg.cov_queue):
        cov_queue.put(i)
    san_queue = Queue()
    for i in utils.load_pickle(cfg.san_queue):
        san_queue.put(i)

    query_thread = Thread(target=query_loop, args=(llm, seed_data, llm_queue, cov_queue))
    coverage_thread = Thread(target=coverage_loop, args=(
        seed_data, llm_queue, cov_queue, san_queue))
    sanitization_thread = Thread(target=san.sanitization_loop, args=(seed_data, san_queue))

    query_thread.start()
    coverage_thread.start()
    sanitization_thread.start()
    query_thread.join()
    coverage_thread.join()
    sanitization_thread.join()

if __name__ == "__main__":
    main()
