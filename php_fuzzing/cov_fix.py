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
        with open(php_file, "r") as f:
            code = f.read()
        result = cov_eng.execute_prog(php_file)
        if result == -1:
            print("Bad execution")
            continue
        if err.is_error(result):
            fix_query = generate_fix_prompt(code, err.parse_error(result, php_file))
            fix_req_name = os.path.join(cfg.llm_requests,php_file.split(".")[0]+"_f")
            utils.enter_shared_dir(cfg.llm_requests)
            with open(fix_req_name, 'wb') as f:
                pickle.dump(fix_query, f, protocol=pickle.HIGHEST_PROTOCOL)
            with open(cfg.llm_queue, 'rb') as f:
                requests = pickle.load(f)
            requests.append(fix_req_name)
            utils.exit_shared_dir(cfg.llm_requests)
        else:
            utils.add_to_queue(cfg.san_queue,php_file)

if __name__ == "__main__":
    main()
