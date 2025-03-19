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
import receiver2
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
from phpt_parser import phpt_obj, parse_phpt

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
MAX_FIXES = 1
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

def load_seed_corpus(seed_corpus_directory):
    command = ['bash','./corpus_loader.sh',seed_corpus_directory]
    subprocess.run(command,text=True,timeout=40,capture_output=True)
    with open("tmp_files.txt",'r') as f:
        files = f.readlines()
    os.remove("tmp_files.txt")
    return [i.split("\n")[0] for i in files]

def link_include_files(new_dir):
    command = ['bash','./linker.sh',cfg.includes,new_dir]
    subprocess.run(command,text=True,timeout=40,capture_output=True)

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
            "hour": -1,
            "phpt_obj": phpt_obj(),
            "content":"",
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

        # Generate new corpus
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
        seed_data = utils.load_pickle(cfg.seed_data)
        if seed_name in seed_data:
            seed_node = seed_data[seed_name]
        else:
            seed_node = create_seed_node()
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
                seed_node['phpt_obj'].add_file(child)
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
                seed_node['phpt_obj'].add_file(child)
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

#Rethink phpt_obj
def new_corpus(llm, iterations, out_dir):
    global GEN_NUM
    #i = 0
    type_num = 0
    file_instr = utils.load_pickle(cfg.file_instr)

    while len(os.listdir(out_dir)) < iterations:
        code = None
        instructions = ""

        tmp_phpt = phpt_obj()
        mut_name = str(GEN_NUM+1)+"_b_"+secrets.token_hex(10);

        if type_num == 0: #grammar seed
            new_code = generate_samples(
                    os.path.dirname(__file__),None,"<phpfuzz>",10,"grammar_generators/no_guard_php.txt")
            code = new_code
        elif type_num == 1: #test suite seed
            init_corpus = utils.load_pickle(cfg.init_corpus)
            file = init_corpus.pop(random.randint(0,len(init_corpus)))
            with codecs.open(file,'r', encoding='utf-8', errors='ignore') as f:
                file_content = f.read()
            extensions = parse_phpt(file_content,"--EXTENSIONS--")
            ini = parse_phpt(file_content,"--INI--")
            code = parse_phpt(file_content,"--FILE--")
            for i in extensions.split("\n"):
                tmp_phpt.add_extensions(i)
            for i in ini.split("\n"):
                tmp_phpt.add_ini(i)
            tmp_phpt.add_file(code)
        elif type_num >= 2: #llm seed
            init_corpus = utils.load_pickle(cfg.init_corpus)
            file = init_corpus.pop(random.randint(0,len(init_corpus)))
            with codecs.open(file,'r', encoding='utf-8', errors='ignore') as f:
                file_content = f.read()
            influence = parse_phpt(file_content,"--FILE--")
            context = prompts.new_seed(influence, functions)
            #llm.change_temperature(random.randint(0,10)/10)
            llm.change_temperature(1)
            result = query_llm(llm,context)
            context.append({'role':'assistant','content':result})
            code = correct_format(llm, result, context)
            if code == None: #Idk some weird error that idc about
                continue
            else:
                tmp_phpt.add_file(code)
        with codecs.open(os.path.join(out_dir,mut_name),"w",encoding='utf-8',
                         errors='ignore') as f:
            f.write(tmp_phpt.compile_phpt())
        if type_num == 4:
            type_num = 0
        else:
            type_num += 1

#safe to give seed_data as nothing will be accessing at that time
#add seed nodes to seed data here
def next_gen(llm):
    global GEN_NUM
    new_gen = []
    seed_data = utils.load_pickle(cfg.seed_data)
    file_instr = utils.load_pickle(cfg.file_instr)
    tmp = {}
    if GEN_NUM % 5 == 0 or (
            len([i for i in seed_data if (seed_data[i]['generation'] == GEN_NUM and seed_data[i]['valid'] == True)]) < 50):
        for i in [x for x in os.listdir("gen_" + str(GEN_NUM)) if ".ini" not in x]:
        #for i in os.listdir("gen_" + str(0)):
            #name = i.split(".")[0]
            if name in seed_data and seed_data[name]['valid'] == True:
                tmp[name] = seed_data[name]
    else:
        for i in [x for x in os.listdir("gen_" + str(GEN_NUM)) if ".ini" not in x]:
        #for i in os.listdir("gen_" + str(GEN_NUM)):
            #name = i.split(".")[0]
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

    link_include_files(new_dir)
    for file in cfg.require_files:
        shutil.copy(file,new_dir)

    boot_gen = "boot_"+str(GEN_NUM)
    for crasher in crashers:
        seed_name = secrets.token_hex(10)
        mut_query = prompts.mutate(seed_data[crasher]['content'])
        seed_node = create_seed_node()
        seed_node['parents'] = (crasher, None)
        for i in seed_data[crasher]['phpt_obj'].ini:
            seed_node['phpt_obj'].add_ini(i)
        for i in seed_data[crasher]['phpt_obj'].extensions:
            seed_node['phpt_obj'].add_extensions(i)
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


        #with codecs.open(seed_data[pair[0]]['php_file'],'r',encoding='utf-8',
        #         errors='ignore') as m:
        #    male = m.read()
        male = seed_data[pair[0]]['phpt_obj']
        female = None
        if "_b_" in pair[1]:
            with codecs.open(os.path.join(boot_gen,pair[1]),'r',encoding='utf-8',
                 errors='ignore') as f:
                female_content = f.read()
            female = phpt_obj()
            female.add_file(parse_phpt(female_content,"--FILE--"))
            female.add_ini(parse_phpt(female_content,"--INI--"))
            female.add_extensions(parse_phpt(female_content,"--EXTENSIONS--"))
        else:
            #with codecs.open(seed_data[pair[1]]['php_file'],'r',encoding='utf-8',
            #     errors='ignore') as f:
            #      female = f.read()
            female = seed_data[pair[1]]['phpt_obj']
        seed_node['php_file'] = os.path.join(new_dir,seed_name)
        seed_node['phpt_obj'].add_extensions(female.extensions + male.extensions)
        seed_node['phpt_obj'].add_ini(female.ini + male.ini)
        seed_data[seed_name] = seed_node
        mate_query = prompts.mate(male.code,female.code)
        mate_req_name = os.path.join(cfg.llm_requests,
                                     seed_name + "_ma")
        utils.dump_pickle(mate_req_name, mate_query)
        utils.add_to_queue(cfg.llm_queue, mate_req_name)
        utils.dump_pickle(cfg.seed_data, seed_data)
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
    #This will start/stop the clock. Also, execution_handler uses this as a signal
    #to stop running bc something went very wrong.
    utils.write_file(cfg.time_file,str(int(time.time())))

    if len(utils.load_pickle(cfg.init_corpus)) == 0:
        print("load corpus first and link incs")

    try:
        try:
            role = 'You are a chatting assistant'
            context = [{'role': 'system', 'content': role}]
            llm = receiver2.LLAMA3_LLM(context)
            query_loop(llm)
        except Exception as e:
            print(traceback.format_exc())
            role = 'You are a chatting assistant'
            context = [{'role': 'system', 'content': role}]
            llm = receiver2.LLAMA3_LLM(context)
            query_loop(llm)
    except Exception as e:
        print(traceback.format_exc())
        print(e)
        utils.write_file(cfg.time_file,str(-1))

if __name__ == "__main__":
    main()
