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
seed_data_lock = Lock()

def correct_format(llm, result, context):
    tmp = context.copy()
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
            tmp.append({'role': 'user', 'content': fix_prompt})
            result = llm.give_context(tmp)
        else:
            break
    try:
        if "<?php" not in code.split("\n")[0]:
            code = "<?php\n" + code + "\n?>"
    except Exception as e:
        print("ERRRORRRRRR")
        print(code)
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
    prompt += "\nMix Code A and Code B together in 3 different ways. Return as ```<code>```\
            \n```<code>``` \n```<code>```"
    #prompt += "Use Code B in Code A. Do not simply append B to A." ?
    context.append({'role':'user','content':prompt})
    return context

def minimize(seed):
    print("minimize this")

def update_data(iteration, llm_queue, cov_queue, removal_list):
    if iteration == 20:
        utils.dump_pickle(cfg.llm_queue, list(llm_queue.queue))
        utils.dump_pickle(cfg.cov_queue, list(cov_queue.queue))
        return 0
    else:
        return iteration + 1

def query_loop(seed_data, llm_queue, cov_queue):
    role = 'You are a chatting assistant'
    context = [{'role': 'system', 'content': role}]
    llm = receiver.LLAMA3_LLM(context)

    i = 0
    removal_list = []
    while(True):
        request_file = llm_queue.get() # blocking function
        seed_name = request_file.split("/")[-1].split("_")[0]
        php_file = os.path.join(cfg.php_corpus,
                request_file.split("/")[-1].split("_")[0]+".php")
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
        if("_t" in request_file): 
            print("Translating: {}".format(request_file))
            context = utils.load_pickle(request_file)
            os.remove(request_file)
            result = llm.give_context(context)
            context.append({'role':'assistant','content':result})
            code = correct_format(llm, result, context)
            utils.write_file(php_file, code)
            cov_queue.put(php_file)
        elif("_f" in request_file): #Fix request
            print("Fixing: {}".format(request_file))
            if seed_data[seed_name]['fix_count'] == 5:
                os.remove(request_file)
                print("Nah, can't fix this one")
            else:
                context = utils.load_pickle(request_file)
                # let's just give it the present context
                #if data['fix_count'] == 0:
                #    data['context'] = context
                #else:
                #    data['context'].append(context[-1])
                #    context = data['context'] #Perhaps we just want to give it the present context
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
        i = update_data(i, llm_queue, cov_queue, removal_list)

def coverage_loop(seed_data, llm_queue, cov_queue):
    cov_eng = Executor(cfg.coverage_engine)
    while(True):
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

def sanitization_loop(seed_data, llm_queue, cov_queue):
    san_eng = Executor(cfg.sanitizer_engine)
    while(True):
        php_file = utils.pop_from_queue(cfg.san_queue)
        if php_file == -1:
            continue
        result = san_eng.execute_prog(php_file)
        if result == -1:
            print("really suspicious:", php_file)
            continue
        if san_eng.ret_code != 0:
            if san_eng.ret_code == 255:
                print("EXCEPTION ", php_file)
                os.remove(php_file)
            elif san_eng.ret_code == 124:
                print("TIMEOUT ", php_file)
                os.remove(php_file)
            elif san_eng.ret_code == 153:
                print("MEMORY LEAK", php_file)
                os.remove(php_file)
            elif "Allowed memory size of" in result:
                print("OOM", php_file)
                os.remove(php_file)
            elif "AddressSanitizer failed to allocate" in result:
                print("OOM", php_file)
                os.remove(php_file)
            elif "Assertion" in result:
                print("ASSERTION", php_file)
                os.remove(php_file)
            else:
                print("POTENTIAL VULN", php_file)
        else:
            print("OK")
            os.remove(php_file)

def mutation_loop(seed_data, llm_queue, cov_queue):
    ...

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
