import traceback
import time
import codecs
import shutil
import time
import re
import secrets
import random
import itertools
import os
import receiver4
import config as cfg
import utils
import pickle
from queue import Queue
from threading import Thread, Lock
from executor import Executor
import errreader as err
from aljamain_sterling import pairing_aljo, new_aljo, scoring_function, new_scoring_function
from grammar_generators.php_gen import generate_samples
import san
import prompts

fix_prompt = "The response did not follow the ```<code>``` format."
min_prompt = "Reduce the amount of tokens in this code. Return as ```<code>```"
seed_data_lock = Lock()

tmp = []
for i in os.listdir(os.getcwd()):
    if "gen_" in i:
        tmp.append(int(i.split("_")[1]))
if len(tmp) == 0:
    GEN_NUM = 0
else:
    GEN_NUM = max(tmp) #Current generation
TOKEN_LIMIT = 3900 #Given that the context window is 8000 for our LLM,
                   #our cutoff will be 3900 tokens.
MAX_FIXES = 5
del(tmp)

functions = utils.load_pickle('functions.pickle')

def n_tile(lst, ntile):
    size = -(len(lst)//-ntile)
    for i in range(0, len(lst), size):
        yield lst[i:i + size]

def query_llm(llm, context):
    result = llm.give_context(context)
    if result == "-1" or result == "-2":
        result = llm.give_context(context)
        if result == "-1" or result == "-2":
            return -1
    else:
        return result

def correct_format(llm, result, context):
    llm.change_temperature(0.6)
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
            utils.log("\n! Re-query: Format Error !\n")
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

def update_data(llm_queue, cov_queue, seed_data, san_queue=None):
    utils.dump_pickle(cfg.llm_queue, list(llm_queue.queue))
    utils.dump_pickle(cfg.cov_queue, list(cov_queue.queue))
    if san_queue != None:
        utils.dump_pickle(cfg.san_queue, list(san_queue.queue))
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

def create_seed_node():
    global GEN_NUM
    seed_node = {
            "valid": False,
            "reset_count": 0,
            "fix_count": 0,
            "max_fixes": 0,
            "php_file": None,
            "context": None,
            "parents": None,
            "time": 0,
            "solo_cov": None,
            "new_cov": None,
            "size": None, #AKA token length
            "crash": None,
            "generation": GEN_NUM,
            "ranking": None,
            "ancestry": 0,
            "score": None,
            "hour": -1
            #"score":0, #The score will be updated after every generation
            }
    return seed_node

def query_loop(llm):
    global GEN_NUM
    safe_files = os.listdir(os.path.dirname(os.path.realpath(__file__)))
    partner_died = lambda : int(utils.read_file(cfg.time_file)) == -1
    while(True):
        if partner_died():
            quit()
        if len(utils.load_pickle(cfg.llm_queue)) == 0 and (
                len(utils.load_pickle(cfg.exec_queue)) == 0):
            continue
        #    outdir = "boot_" + str(GEN_NUM+1)
        #    safe_files.append(outdir)
        #    safe_files.append("gen_"+str(GEN_NUM+1))
        #    if not(os.path.exists(outdir)):
        #        os.makedirs(outdir)
        #    newcole=len(os.listdir("gen_0"))
        #    new_corpus(llm, newcole, outdir)
        #    next_gen(llm)
        request_file = utils.pop_from_queue(cfg.llm_queue)
        if request_file == -1:
            continue
        seed_name = request_file.split("/")[-1].split("_")[0]
        #php_file = os.path.join(cfg.php_corpus,
        #        request_file.split("/")[-1].split("_")[0]+".php")
        seed_data = utils.load_pickle(cfg.seed_data)
        if seed_name in seed_data:
            seed_node = seed_data[seed_name]
        else:
            seed_node = create_seed_node()
        #create_seed_data(seed_data, seed_name, php_file)
        #This needs to be fixed: php_file
        if("_t" in request_file):
            llm.change_temperature(random.randint(0,10)/10)
            start = time.time()
            #utils.log("Translating: {}".format(request_file))
            context = utils.load_pickle(request_file)
            result = query_llm(llm,context)
            context.append({'role':'assistant','content':result})
            code = correct_format(llm, result, context)
            if code == None:
                #seed_data[seed_name]['fix_count'] = MAX_FIXES
                #update_data(llm_queue, cov_queue, seed_data)
                continue
            utils.write_file(php_file, code)
            seed_node['php_file'] = php_file
            seed_node['time'] = time.time() - start
            utils.add_to_queue(cfg.exec_queue, php_file)
        elif("_ma" in request_file): #Mate request
            #llm.change_temperature(random.randint(0,10)/10)
            llm.change_temperature(1)
            start = time.time()
            context = utils.load_pickle(request_file)
            result = query_llm(llm,context)
            context.append({'role':'assistant','content':result})
            child = correct_format(llm, result, context)
            if child == None:
                seed_node['fix_count'] = MAX_FIXES
                #seed_node['fix_count'] = seed_node['max_fixes']
            else:
                #dr = "gen_" + str(GEN_NUM)
                #php_file = os.path.join(dr,seed_name+".php")
                #seed_node['php_file'] = php_file
                php_file = seed_node['php_file']
                utils.write_file(php_file,child)
                seed_node['time'] += time.time() - start
                utils.add_to_queue(cfg.exec_queue, php_file)
        elif("_mu" in request_file): #mutating crash
            #llm.change_temperature(random.randint(0,10)/10)
            llm.change_temperature(1)
            start = time.time()
            context = utils.load_pickle(request_file)
            result = query_llm(llm,context)
            context.append({'role':'assistant','content':result})
            child = correct_format(llm, result, context)
            if child == None:
                seed_node['fix_count'] = MAX_FIXES
                #seed_node['fix_count'] = seed_node['max_fixes']
            else:
                #dr = "gen_" + str(GEN_NUM)
                #php_file = os.path.join(dr,seed_name+".php")
                php_file = seed_node['php_file']
                utils.write_file(php_file,child)
                seed_node['time'] += time.time() - start
                utils.add_to_queue(cfg.exec_queue, php_file)
        elif("_f" in request_file): #Fix request
            llm.change_temperature(0.3)
            start = time.time()
            php_file = seed_node['php_file']
            #utils.log("Fixing: {}".format(request_file))
            #seed_node = utils.load_pickle(cfg.seed_data)[seed_name]
            #if seed_node['fix_count'] >= seed_node['max_fixes']:
            if seed_node['fix_count'] >= MAX_FIXES:
                #utils.log("Nah, can't fix this one")
                if 'corpus' not in php_file: #this indicates either the original js/php corpi
                    seed_node['valid'] = False
                    #os.remove(php_file)
                    seed_data = utils.load_pickle(cfg.seed_data)
                    seed_data[seed_name] = seed_node
                    #del(seed_data[seed_name])
                    utils.dump_pickle(cfg.seed_data, seed_data)
                    #update_data(llm_queue, cov_queue, seed_data)
                    os.remove(request_file)
                    #llm.change_temperature(0.6)
                    continue
            else:
                context = utils.load_pickle(request_file)
                seed_node['fix_count'] += 1
                #Maybe make this an inherent feature of queries
                if utils.num_tokens_from_context(context) > cfg.llama3_max / 2:
                    utils.log("trying to fix... too big")
                else:
                    result = query_llm(llm,context)
                    context.append({'role':'assistant','content':result})
                    code = correct_format(llm, result, context)
                    if code == None:
                        seed_node['valid'] = False
                        #seed_node['fix_count'] = MAX_FIXES
                        seed_data = utils.load_pickle(cfg.seed_data)
                        seed_data[seed_name] = seed_node
                        #del(seed_data[seed_name])
                        utils.dump_pickle(cfg.seed_data, seed_data)
                        #update_data(llm_queue, cov_queue, seed_data)
                        os.remove(request_file)
                        #llm.change_temperature(0.6)
                        continue
                    utils.write_file(php_file, code)
                    utils.add_to_queue(cfg.exec_queue, php_file)
                    seed_node['time'] += time.time() - start
        seed_data = utils.load_pickle(cfg.seed_data)
        seed_data[seed_name] = seed_node
        utils.dump_pickle(cfg.seed_data, seed_data)
        #llm.change_temperature(0.6)
        os.remove(request_file)
        #update_data(llm_queue, cov_queue, seed_data)

def new_corpus(llm, iterations, out_dir):
    global GEN_NUM
    #i = 0
    type_num = 0
    #file_instr = utils.load_pickle(cfg.file_instr)
    while len(os.listdir(out_dir)) < iterations:
        code = None
        instructions = ""
        if type_num == 9 or type_num == 9:
            phptests = utils.load_pickle(cfg.phptests)
            test_files = phptests[0]
            used_files = phptests[1]
            if len(test_files) == 0:
                test_files = used_files.copy()
                used_files = []
            #target_file = test_files.pop(random.randint(0,len(test_files)))


            target_file = None
            good_file = False
            code = None
            #while(".phpt" not in target_file):
            while(not good_file):
                if len(test_files) == 0:
                    test_files = used_files.copy()
                    used_files = []
                target_file = test_files.pop(random.randint(0,len(test_files)))
                target_path = os.path.join(os.path.expanduser("~"),target_file)
                if ".phpt" in target_path:
                    #try:
                    with codecs.open(target_path,'r',encoding='utf-8',
                                     errors='ignore') as f:
                        #with open(target_path,"r") as f:
                        code = f.read()
                    if "--FILE--" in code:
                        good_file = True
                        used_files.append(target_file)
                    #except Exception as e:
                    #    continue

            #used_files.append(target_file)
            #target_file = os.path.join(os.path.expanduser("~"),target_file)
            #try:
            #    with open(target_file,"r") as f:
            #        code = f.read()
            #except Exception as e:
            #    continue

            if "--INI--" in code:
                noncodelines = code.split("--INI--")[1].split("\n")
                for line in noncodelines:
                    if line.count("--") == 2:
                        break;
                    elif not line.isspace() and line != '':
                        instructions += " -d {}".format(line) #???????
                        #instructions += line + "\n"

            #code = code.split("--FILE--")[1].split("?>")[0] + "\n?>"
            try:
                code = "<?php\n" + code.split("<?php\n")[1]
                code = code.split("?>")[0] + "\n?>"
            except Exception as e:
                continue
            utils.dump_pickle(cfg.phptests,(test_files,used_files))
        elif type_num == 0:
            new_code = generate_samples(
                    os.path.dirname(__file__),None,"<phpfuzz>",10,"grammar_generators/no_guard_php.txt")
            code = new_code
        elif type_num == 1:
            bug_list = utils.load_pickle("phpbugs.pickle")[0]
            used_list = utils.load_pickle("phpbugs.pickle")[1]
            if len(bug_list) == 0:
                bug_list = used_list.copy()
                used_list = []
            bug = random.choice(bug_list)
            bug_list.remove(bug); used_list.append(bug)
            bug = os.path.join(os.path.expanduser("~"),bug)
            utils.dump_pickle("phpbugs.pickle",(bug_list,used_list))
            #with codecs.open(os.path.join('native_crashers',
            #                              random.choice(os.listdir('native_crashers'))),
            #                 'r', encoding='utf-8',
            #                 errors='ignore') as f:
            #    influence = f.read()
            with codecs.open(bug,'r', encoding='utf-8', errors='ignore') as f:
                influence = f.read()
            try:
                influence = "<?php\n" + influence.split("<?php")[1]
                influence = influence.split("?>")[0] + "?>"
            except Exception as e:
                pass
            context = prompts.new_seed(type_num, influence, functions, new_code)
            #llm.change_temperature(random.randint(0,10)/10)
            llm.change_temperature(1)
            result = query_llm(llm,context)
            context.append({'role':'assistant','content':result})
            code = correct_format(llm, result, context)
            if code == None: #Idk some weird error that idc about
                continue
        mut_name = str(GEN_NUM+1)+"_b_"+secrets.token_hex(10);
        with codecs.open(os.path.join(out_dir,mut_name),"w",encoding='utf-8',
                         errors='ignore') as f:
            f.write(code)
        #file_instr[mut_name] = instructions
        #utils.dump_pickle(cfg.file_instr,file_instr)
        #if type_num == 3:
        #if type_num == 2:
        #if type_num == 4:
        if type_num == 1:
            type_num = 0
        else:
            type_num += 1
        #utils.add_to_queue(cfg.exec_queue,os.path.join(out_dir,mut_name))
    #llm.change_temperature(0.6)

#safe to give seed_data as nothing will be accessing at that time
#add seed nodes to seed data here
def next_gen(llm):
    global GEN_NUM
    new_gen = []
    seed_data = utils.load_pickle(cfg.seed_data)
    #file_instr = utils.load_pickle(cfg.file_instr)
    tmp = {}
    if GEN_NUM % 5 == 0 or (
            len([i for i in seed_data if (seed_data[i]['generation'] == GEN_NUM and seed_data[i]['valid'] == True)]) < 50):
        for i in os.listdir("gen_" + str(0)):
            name = i.split(".")[0]
            if name in seed_data and seed_data[name]['valid'] == True:
                tmp[name] = seed_data[name]
    else:
        for i in os.listdir("gen_" + str(GEN_NUM)):
            name = i.split(".")[0]
            if name in seed_data and seed_data[name]['valid'] == True:
                tmp[name] = seed_data[name]
    partitions = new_scoring_function(tmp)
    crashers = partitions[0]
    ranking = partitions[1]
    name_score = partitions[2]
    name_energy = partitions[3]
    for i in name_score:
        seed_data[i]['score'] = name_score[i]
    partitions = (crashers,ranking)
    aljo_result = new_aljo(GEN_NUM,partitions, name_energy)
    pairs = aljo_result[0]
    crashers = aljo_result[1]
    GEN_NUM+=1
    new_dir = "gen_" + str(GEN_NUM)
    os.makedirs(new_dir)
    for file in cfg.require_files:
        shutil.copy(file,new_dir)
    boot_gen = "boot_"+str(GEN_NUM)
    for crasher in crashers:
        seed_name = secrets.token_hex(10)
        mut_query = prompts.mutate(seed_data[crasher]['php_file'])
        seed_node = create_seed_node()
        seed_node['parents'] = (crasher, None)
        seed_node['php_file'] = os.path.join(new_dir,seed_name)
        seed_data[seed_name] = seed_node
        mut_req_name = os.path.join(cfg.llm_requests, seed_name + "_mu")
        utils.dump_pickle(mut_req_name, mut_query)
        utils.add_to_queue(cfg.llm_queue, mut_req_name)
    for pair in pairs:
        instructions = ""
        seed_name = secrets.token_hex(10)
        new_gen.append(seed_name)
        seed_node = create_seed_node()
        seed_node['parents'] = (pair[0],pair[1])

        #if pair[0] in file_instr and file_instr[pair[0]] != "":
        #    instructions += file_instr[pair[0]]
        #if pair[1] in file_instr and file_instr[pair[1]] != "":
        #    instructions += "\n" and file_instr[pair[1]]
        #file_instr[seed_name] = instructions

        with codecs.open(seed_data[pair[0]]['php_file'],'r',encoding='utf-8',
                 errors='ignore') as m:
            male = m.read()
        female = None
        if "_b_" in pair[1]:
            with codecs.open(os.path.join(boot_gen,pair[1]),'r',encoding='utf-8',
                 errors='ignore') as f:
                female = f.read()
        else:
            with codecs.open(seed_data[pair[1]]['php_file'],'r',encoding='utf-8',
                 errors='ignore') as f:
                  female = f.read()
        seed_node['php_file'] = os.path.join(new_dir,seed_name)
        seed_data[seed_name] = seed_node
        mate_query = prompts.mate(male,female)
        mate_req_name = os.path.join(cfg.llm_requests,
                                     seed_name + "_ma")
        utils.dump_pickle(mate_req_name, mate_query)
        utils.add_to_queue(cfg.llm_queue, mate_req_name)
        utils.dump_pickle(cfg.seed_data, seed_data)
        #utils.dump_pickle(cfg.file_instr, file_instr)
    #ancestry score and fix_amount calculation
    combined_parent_scores = {}
    for i in new_gen:
        combined_parent_scores[i] = 0
        father = seed_data[i]['parents'][0]
        mother = seed_data[i]['parents'][1]
        if GEN_NUM-1 == 0:
            if father in seed_data:
                seed_data[i]['ancestry'] += 1
                if seed_data[father]['score'] != None:
                    combined_parent_scores[i] += seed_data[father]['score']
            if mother in seed_data:
                seed_data[i]['ancestry'] += 1
                if seed_data[mother]['score'] != None:
                    combined_parent_scores[i] += seed_data[mother]['score']
        else:
            if father in seed_data:
                seed_data[i]['ancestry'] += seed_data[father]['ancestry']
                if seed_data[father]['score'] != None:
                    combined_parent_scores[i] += seed_data[father]['score']
            if mother in seed_data:
                seed_data[i]['ancestry'] += seed_data[mother]['ancestry']
                if seed_data[mother]['score'] != None:
                    combined_parent_scores[i] += seed_data[mother]['score']
        utils.dump_pickle(cfg.seed_data, seed_data)
    score = {k: v for k, v in sorted(combined_parent_scores.items(), key=lambda item: item[1], reverse = True)}
    quintiles = list(n_tile(list(score.keys()),5))
    loop_count = len(quintiles)
    fix_amounts = list(range(6))[1:]
    for i in range(len(quintiles)):
        fix = fix_amounts.pop()
        for name in quintiles[i]:
            seed_data[name]['max_fixes'] = fix
    utils.dump_pickle(cfg.seed_data, seed_data)
    return

def main():
    #seed_data = utils.load_pickle(cfg.seed_data)
    #This will start/stop the clock. Also, execution_handler uses this as a signal
    #to stop running bc something went very wrong.
    utils.write_file(cfg.time_file,str(int(time.time())))

    try:
        try:
            role = 'You are a chatting assistant'
            context = [{'role': 'system', 'content': role}]
            llm = receiver4.LLAMA3_LLM(context)
            query_loop(llm)
        except Exception as e:
            print(traceback.format_exc())
            role = 'You are a chatting assistant'
            context = [{'role': 'system', 'content': role}]
            llm = receiver4.LLAMA3_LLM(context)
            query_loop(llm)
    except Exception as e:
        print(traceback.format_exc())
        print(e)
        utils.write_file(cfg.time_file,str(-1))

if __name__ == "__main__":
    main()
