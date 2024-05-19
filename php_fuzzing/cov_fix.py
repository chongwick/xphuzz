import os
import config as cfg
import utils
import pickle
from executor import Executor
import errreader as err

def generate_fix_prompt(code, error):
    role = 'Fix PHP code. Return as ```<code>```'
    context = [{'role': 'system', 'content': role}]
    prompt = ""
    prompt += "```\n{c}\n```\n".format(c=code)
    prompt += error
    context.append({'role': 'user', 'content': prompt})
    return context

def main():
    cov_eng = Executor(cfg.coverage_engine)

    while(True):
        php_file = utils.pop_from_queue(cfg.cov_queue)
        if php_file == -1:
            continue
        #cov_queue = utils.load_pickle(cfg.cov_queue)
        #if len(cov_queue) == 0:
        #    continue
        #php_file = cov_queue.pop(0)
        #utils.dump_pickle(cfg.cov_queue, cov_queue)
        code = utils.read_file(php_file)
        result = cov_eng.execute_prog(php_file)
        if result == -1:
            print("Bad execution")
            continue
        if err.is_error(result):
            fix_query = generate_fix_prompt(code, err.parse_error(result, php_file))
            fix_req_name = os.path.join(cfg.llm_requests,php_file.split(".")[0]+"_f")
            utils.dump_pickle(fix_req_name, fix_query)
            utils.add_to_queue(cfg.llm_queue, fix_req_name)
            #requests = utils.load_pickle(cfg.llm_queue)
            #requests.append(fix_req_name)
            #utils.dump_pickle(cfg.llm_queue, requests)

        else:
            utils.add_to_queue(cfg.san_queue,php_file)

if __name__ == "__main__":
    main()
