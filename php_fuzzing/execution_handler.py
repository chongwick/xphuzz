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
                        "blank.php" not in i) and (
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
                len(code.split("\n")) < 7):
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
        if err.is_error(result):
            fix_query = prompts.fix(code, err.parse_error(result, php_file))
            fix_req_name = os.path.join(cfg.llm_requests,
                                        php_file.split("/")[-1].split(".")[0]+"_f")
            utils.dump_pickle(fix_req_name, fix_query)
            utils.add_to_queue(cfg.llm_queue, fix_req_name)
        else:
            #sanitizeeeee
            print('sanitizing')
            start_time = int(utils.read_file(cfg.time_file))
            if start_time == -1:
                quit()
            else:
                #hour = int((time.time() - start_time) // 1800) #use if double gpu
                hour = int((time.time() - start_time) // 3600)
            valid = True
            solo_coverage = None
            crash = None
            is_error = lambda x: os.path.exists(x+".er")
            is_trash = lambda x: os.path.exists(x+".tr")
            if result == 'seg':
                solo_coverage = 1
            else:
                solo_coverage = cov_eng.read()
                #remap
                #cov_eng.load_global_coverage_map_from_file(cfg.collective_map)
                #cur_cov = cov_eng.read()
                #result = cov_eng.execute_prog(php_file)
                #new_coverage = cov_eng.read() - cur_cov
                #cov_eng.save_global_coverage_map_in_file(cfg.collective_map)

            command = ['bash','./sanitize.sh',os.path.join(os.getcwd(),php_file)]
            child = None
            try:
                child = subprocess.run(command,
                                       text=True,
                                       timeout=40,
                                       capture_output=True)
            except subprocess.TimeoutExpired as exc:
                valid = False
                break
            if is_error(php_file):
                php_file = php_file+".er"
                crash = None
                error = None
                #category = None
                if "quit(" in code:
                    crash = "NC"
                    error = 'exit'
                else:
                    crash = i
                    error = utils.read_file(cfg.san_log)
                    #category = None
                    try:
                        error = error.split("/w023dtc/")[1].split(" ")[0]
                    except Exception as e:
                        error = error
                bugs = utils.load_pickle(cfg.bug_log)
                if error not in bugs:
                    bugs[error]=[seed_name + instructions]
                else:
                    bugs[error].append(seed_name)
                utils.dump_pickle(cfg.bug_log,bugs)
                break
            else:
                crash = "NC"
            seed_data = utils.load_pickle(cfg.seed_data)

            if is_trash(php_file):
                php_file = php_file+".tr"
                os.rename(php_file,php_file.split(".tr")[0])
                seed_data[seed_name]['valid'] = True
                seed_data[seed_name]['hour'] = hour
                seed_data[seed_name]['solo_cov'] = solo_coverage
                #seed_data[seed_name]['new_cov'] = new_coverage
                seed_data[seed_name]['php_file'] = php_file.split(".tr")[0]
                seed_data[seed_name]['crash']="trash"
                seed_data[seed_name]['size']=utils.num_tokens_from_string(code)
                #del(seed_data[seed_name])
            else:
                os.rename(php_file,php_file.split(".er")[0])
                seed_data[seed_name]['valid'] = valid
                seed_data[seed_name]['hour'] = hour
                seed_data[seed_name]['solo_cov'] = solo_coverage
                #seed_data[seed_name]['new_cov'] = new_coverage
                seed_data[seed_name]['php_file']=php_file.split(".er")[0]
                seed_data[seed_name]['crash']=crash
                seed_data[seed_name]['size']=utils.num_tokens_from_string(code)
            #if is_instructions:
            #    os.remove(os.path.join(cfg.inidir,seed_name))
            utils.dump_pickle(cfg.seed_data,seed_data) #update data!!!
        room_service(safe_files)

def main():
    exec_loop()

if __name__ == "__main__":
    main()
