from random import choice
import time
import codecs
import shutil
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
                        "blank.js" not in i) and (
                            "boot_" not in i) and (
                                    i[0] != '.'):
            path = os.path.join(dir_path,i)
            if os.path.isdir(path):
                try:
                    shutil.rmtree(path)
                except Exception as e:
                    pass
            else:
                try:
                    os.remove(path)
                except Exception as e:
                    continue

#There are multiple execution loops but only one llm loop, use the llm loop for the new gen
def exec_loop():
    seed_data = None
    llm_queue = None
    exec_queue = None
    #safe_files = utils.load_pickle(cfg.safe_files)
    safe_files = os.listdir(os.path.dirname(os.path.realpath(__file__)))
    cov_eng = Executor(cfg.coverage_engine)
    partner_died = lambda : int(utils.read_file(cfg.time_file)) == -1
    while(True):
        if partner_died():
            quit()
        php_file = utils.pop_from_queue(cfg.exec_queue)
        if php_file == -1:
            continue
        #file_instr = utils.load_pickle(cfg.file_instr)
        seed_name = php_file.split("/")[-1].split(".")[0]
        hour = -1

        #update_data(llm_queue, cov_queue, seed_data)
        print("mapping: " + php_file)
        cov_eng.load_global_coverage_map_from_file(cfg.base_map)
        code = utils.read_file(php_file)

        result = None
        if "rm " in code or "rmdir" in code or "\'rm" in code or "\"rm" in code or (
                len(code.split("\n")) < 3):
            result = -1
        else:
            #utils.write_file(php_file,code)
            result = cov_eng.execute_prog(php_file)

            current_files = os.listdir(
                    os.path.dirname(os.path.realpath(__file__)))
            tmp = [i for i in current_files if (
                i not in safe_files and
                "blank.js" not in i and
                "gen_" not in i and
                "boot_" not in i)]
            if len(tmp) > 100:
                result = -1

        if result == -1:
            seed_data = utils.load_pickle(cfg.seed_data)
            seed_data[seed_name]['valid'] = False
            utils.dump_pickle(cfg.seed_data,seed_data) #update data!!!
            continue
        else:
            ret_code = result[0]
            stdout = result[1]
            stderr = result[2]
            if ret_code == 1:
                if "Sanitizer" in stdout or "Sanitizer" in stderr:
                    bugs = utils.load_pickle(cfg.bug_log)
                    bugs[stdout+stderr] = seed_name
                    utils.dump_pickle(cfg.bug_log,bugs)
                    seed_data[seed_name]['solo_cov'] = None
                    seed_data[seed_name]['valid'] = True
                    seed_data[seed_name]['hour'] = hour
                    seed_data[seed_name]['size']=utils.num_tokens_from_string(code)
                    seed_data[seed_name]['crash']="None"
                else:
                    error = '\n'.join(stdout.splitlines()[2:])
                    fix_query = prompts.fix(code, error)
                    fix_req_name = os.path.join(cfg.llm_requests,
                                                php_file.split("/")[-1].split(".")[0]+"_f")
                    utils.dump_pickle(fix_req_name, fix_query)
                    utils.add_to_queue(cfg.llm_queue, fix_req_name)
            else:
                solo_coverage = cov_eng.read()
                seed_data[seed_name]['solo_cov'] = solo_coverage
                seed_data[seed_name]['valid'] = True
                seed_data[seed_name]['hour'] = hour
                seed_data[seed_name]['size']=utils.num_tokens_from_string(code)
                seed_data[seed_name]['crash']="None"

            utils.dump_pickle(cfg.seed_data,seed_data) #update data!!!
        room_service(safe_files)

def main():
    exec_loop()

if __name__ == "__main__":
    main()
