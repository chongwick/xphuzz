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
from aljamain_sterling import pairing_aljo, new_aljo, scoring_function
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
GEN_NUM = max(tmp) #Current generation
TOKEN_LIMIT = 3900 #Given that the context window is 8000 for our LLM,
                   #our cutoff will be 3900 tokens.
MAX_FIXES = 1
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

def new_corpus(llm, iterations, out_dir):
    global GEN_NUM
    #i = 0
    while len(os.listdir(out_dir)) != iterations:
        new_code = generate_samples(
                os.path.dirname(__file__),None,"<phpfuzz>",2,"no_guard_php.txt")
        mut_name = str(GEN_NUM+1)+"_b_"+secrets.token_hex(10);
        with open(os.path.join(out_dir,mut_name),"w") as f:
            f.write(new_code)
        continue
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
            "reset_count": 0,
            "fix_count": 0,
            "php_file": None,
            "context": None,
            "parents": None, #we don't want inbreeding !!!Parents should be a set!!!
            "time": 0,
            "solo_cov": None,
            "new_cov": None,
            "size": None, #AKA token length
            "crash": None, 
            "generation": GEN_NUM,
            "ranking": None,
            #"score":0, #The score will be updated after every generation
            }
    return seed_node

def query_loop(llm):
    global GEN_NUM
    safe_files = os.listdir(os.path.dirname(os.path.realpath(__file__)))
    while(True):
        if len(utils.load_pickle(cfg.llm_queue)) == 0 and (
                len(utils.load_pickle(cfg.exec_queue)) == 0):
            outdir = "boot_" + str(GEN_NUM+1)
            safe_files.append(outdir)
            safe_files.append("gen_"+str(GEN_NUM+1))
            if not(os.path.exists(outdir)):
                os.makedirs(outdir)
            new_corpus(llm, 456, outdir)
            next_gen()
        request_file = utils.pop_from_queue(cfg.llm_queue)
        if request_file == -1:
            continue
        seed_name = request_file.split("/")[-1].split("_")[0]
        php_file = os.path.join(cfg.php_corpus,
                request_file.split("/")[-1].split("_")[0]+".php")
        seed_data = utils.load_pickle(cfg.seed_data)
        if seed_name in seed_data:
            seed_node = seed_data[seed_name]
        else:
            seed_node = create_seed_node()
        #create_seed_data(seed_data, seed_name, php_file)
        if("_t" in request_file): 
            start = time.time()
            #utils.log("Translating: {}".format(request_file))
            context = utils.load_pickle(request_file)
            os.remove(request_file)
            result = query_llm(llm,context)
            context.append({'role':'assistant','content':result})
            code = correct_format(llm, result, context)
            if code == None:
                seed_data[seed_name]['fix_count'] = MAX_FIXES
                update_data(llm_queue, cov_queue, seed_data)
                continue
            utils.write_file(php_file, code)
            seed_node['php_file'] = php_file
            seed_node['time'] += time.time() - start
            utils.add_to_queue(cfg.exec_queue, php_file)
        elif("_ma" in request_file): #Mate request
            start = time.time()
            context = utils.load_pickle(request_file)
            os.remove(request_file)
            result = query_llm(llm,context)
            context.append({'role':'assistant','content':result})
            child = correct_format(llm, result, context)
            if child == None:
                seed_node['fix_count'] = MAX_FIXES
            else:
                dr = "gen_" + str(GEN_NUM)
                php_file = os.path.join(dr,seed_name+".php")
                seed_node['php_file'] = php_file
                utils.write_file(php_file,child)
                seed_node['time'] += time.time() - start
                utils.add_to_queue(cfg.exec_queue, php_file)
        elif("_mu" in request_file): #mutating crash
            start = time.time()
            context = utils.load_pickle(request_file)
            os.remove(request_file)
            result = query_llm(llm,context) 
            context.append({'role':'assistant','content':result})
            child = correct_format(llm, result, context)
            if child == None:
                seed_node['fix_count'] = MAX_FIXES
            else:
                dr = "gen_" + str(GEN_NUM)
                php_file = os.path.join(dr,seed_name+".php")
                utils.write_file(php_file,child)
                seed_node['time'] += time.time() - start
                cov_queue.put(php_file); 
                utils.add_to_queue(cfg.exec_queue, php_file)
        elif("_f" in request_file): #Fix request
            start = time.time()
            #utils.log("Fixing: {}".format(request_file))
            seed_node = utils.load_pickle(cfg.seed_data)[seed_name]
            if seed_node['fix_count'] >= MAX_FIXES:
                os.remove(request_file)
                #utils.log("Nah, can't fix this one")
                if 'corpus' not in php_file: #this indicates either the original js/php corpi
                    os.remove(php_file)
            else:
                context = utils.load_pickle(request_file)
                seed_node[seed_name]['fix_count'] += 1
                os.remove(request_file)
                #Maybe make this an inherent feature of queries
                if utils.num_tokens_from_context(context) > cfg.llama3_max / 2:
                    utils.log("trying to fix... too big")
                else:
                    result = query_llm(llm,context)
                    context.append({'role':'assistant','content':result})
                    code = correct_format(llm, result, context)
                    if code == None:
                        seed_node['fix_count'] = MAX_FIXES
                        seed_data = utils.load_pickle(cfg.seed_data)
                        seed_data[seed_name] = seed_node
                        utils.dump_pickle(cfg.seed_data, seed_data)
                        #update_data(llm_queue, cov_queue, seed_data)
                        continue
                    utils.write_file(php_file, code)
                    utils.add_to_queue(cfg.exec_queue, php_file)
                    seed_node['time'] += time.time() - start
        seed_data = utils.load_pickle(cfg.seed_data)
        seed_data[seed_name] = seed_node
        utils.dump_pickle(cfg.seed_data, seed_data)
        #update_data(llm_queue, cov_queue, seed_data)

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

#safe to give seed_data as nothing will be accessing at that time
def next_gen():
    seed_data = utils.load_pickle(cfg.seed_data)
    global GEN_NUM
    tmp = {}
    for i in os.listdir("gen_" + str(GEN_NUM)):
        name = i.split(".")[0]
        tmp[name] = seed_data[name]
    partitions = scoring_function(tmp)
    aljo_result = new_aljo(GEN_NUM,partitions)
    pairs = aljo_result[0]
    crashers = aljo_result[1]
    GEN_NUM+=1
    new_dir = "gen_" + str(GEN_NUM)
    os.makedirs(new_dir)
    boot_gen = "boot_"+str(GEN_NUM)
    for crasher in crashers:
        seed_name = secrets.token_hex(10)
        mut_query = prompts.mutate(seed_data[crasher]['php_file'])
        seed_node = create_seed_node()
        seed_node['parents'] = (crasher, None)
        seed_data[seed_name] = seed_node
        mut_req_name = os.path.join(cfg.llm_requests, seed_name + "_mu")
        utils.dump_pickle(mut_req_name, mut_query)
        utils.add_to_queue(cfg.llm_queue, mut_req_name)
    for pair in pairs:
        seed_name = secrets.token_hex(10)
        seed_node = create_seed_node()
        seed_node['parents'] = (pair[0],pair[1])
        with open(seed_data[pair[0]]['php_file'],'r') as m:
            male = m.read()
        female = None
        if "_b_" in pair[1]:
            with open(os.path.join(boot_gen,pair[1]),'r') as f:
                female = f.read()
        else:
            with open(seed_data[pair[1]]['php_file'],'r') as f:
                  female = f.read()
        mate_query = prompts.mate(male,female)
        mate_req_name = os.path.join(cfg.llm_requests,
                                     seed_name + "_ma")
        utils.dump_pickle(mate_req_name, mate_query)
        utils.add_to_queue(cfg.llm_queue, mate_req_name)
        '''
        tmp_seed_name = secrets.token_hex(10) #This temporary seed will hold parent data
        #php_file = os.path.join(new_dir,seed_name + ".php")
        create_seed_data(seed_data, tmp_seed_name, None)
        seed_data[tmp_seed_name]['parents'] = (pair[0],pair[1])
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
        mate_query = prompts.mate(male,female)
        mate_req_name = os.path.join(cfg.llm_requests,
                                     tmp_seed_name + "_ma")
        utils.dump_pickle(mate_req_name, mate_query)
        llm_queue.put(mate_req_name)
        '''

def main():
    #seed_data = utils.load_pickle(cfg.seed_data)

    role = 'You are a chatting assistant'
    context = [{'role': 'system', 'content': role}]
    llm = receiver.LLAMA3_LLM(context)
    query_loop(llm)

if __name__ == "__main__":
    main()
