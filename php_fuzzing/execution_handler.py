import os
import config as cfg
import utils
from executor import Executor 
import errreader as err
import prompts
import subprocess

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

#There are multiple execution loops but only one llm loop, use the llm loop for the new gen
def exec_loop():
    seed_data = None
    llm_queue = None
    exec_queue = None
    safe_files = os.listdir(os.path.dirname(os.path.realpath(__file__)))  
    cov_eng = Executor(cfg.coverage_engine)
    while(True):
        php_file = utils.pop_from_queue(cfg.exec_queue)
        if php_file == -1:
            continue
        seed_name = php_file.split("/")[-1].split(".")[0]
        #update_data(llm_queue, cov_queue, seed_data)
        print("mapping: " + php_file)
        cov_eng.load_global_coverage_map_from_file(cfg.base_map)
        code = utils.read_file(php_file)
        if cfg.require_statement not in code:
            code = code.replace("<?php","<?php\n" + cfg.require_statement + "\n")
        utils.write_file(php_file,code)
        result = cov_eng.execute_prog(php_file)
        if result == -1:
            utils.log("Bad execution")
            continue
        if err.is_error(result):
            fix_query = prompts.fix(code, err.parse_error(result, php_file))
            fix_req_name = os.path.join(cfg.llm_requests,
                                        php_file.split("/")[-1].split(".")[0]+"_f")
            utils.dump_pickle(fix_req_name, fix_query)
            utils.add_to_queue(cfg.llm_queue, fix_req_name)
        else:
            #sanitizeeeee
            print('sanitizing')
            valid = True
            coverage = None
            crash = None
            is_error = lambda x: os.path.exists(x+".er")
            is_trash = lambda x: os.path.exists(x+".tr")
            if result == 'seg':
                coverage = 1
            else:
                coverage = cov_eng.read()
            for i in range(3):
                command = ['bash','./sanitize.sh',os.path.join(os.getcwd(),php_file),str(i)]
                child = None
                try:
                    child = subprocess.run(command,
                                           text=True,
                                           timeout=120,
                                           capture_output=True)
                except subprocess.TimeoutExpired as exc:
                    #These take too long. just kill them
                    #crash = "NC"
                    ##utils.write_file(php_file,og)
                    #seed_data[seed_name]['php_file']=php_file
                    #seed_data[seed_name]['crash']=crash
                    #seed_data[seed_name]['size']=utils.num_tokens_from_string(code)
                    break
                if is_error(php_file):
                    php_file = php_file+".er"
                    crash = i
                    error = utils.read_file(cfg.san_log)
                    category = None
                    if 'LeakSanitizer' in error:
                        category = error.split("LeakSanitizer")[1]
                    elif 'runtime error:' in error:
                        category = error.split("runtime error")[1]
                    elif "ERROR:" in error:
                        category = error.split("ERROR")[1]
                    bugs = utils.load_pickle(cfg.bug_log)
                    if category not in bugs:
                        bugs[category]=[seed_name]
                    else:
                        bugs[category].append(seed_name)
                    utils.dump_pickle(cfg.bug_log,bugs)
                    break
                else:
                    crash = "NC"
            seed_data = utils.load_pickle(cfg.seed_data)
            if is_trash(php_file):
                seed_data[seed_name]['valid'] = False
                #del(seed_data[seed_name])
            else:
                seed_data[seed_name]['valid'] = valid
                seed_data[seed_name]['solo_cov'] = coverage
                seed_data[seed_name]['php_file']=php_file
                seed_data[seed_name]['crash']=crash
                seed_data[seed_name]['size']=utils.num_tokens_from_string(code)
            utils.dump_pickle(cfg.seed_data,seed_data) #update data!!!
        room_service(safe_files)

def main():
    exec_loop()

if __name__ == "__main__":
    main()
