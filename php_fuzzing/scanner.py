import shutil
import os
import config as cfg
import utils
from executor import Executor 
import errreader as err
import prompts
import subprocess

def room_service(safe_files):
    dir_path = os.path.dirname(os.path.realpath(__file__))
    cur_files = os.listdir(dir_path)
    for i in cur_files:
        if i not in safe_files and (
                "gen_" not in i) and (
                        "blank.php" not in i) and (
                            "boot_" not in i):
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
    safe_files = os.listdir(os.path.dirname(os.path.realpath(__file__)))  
    cov_eng = Executor(cfg.coverage_engine)
    d = utils.load_pickle(cfg.seed_data)
    tmp = []
    tmp.extend([d[x]['php_file'] for x in d if d[x]['generation'] == 0])
    for i in range(0,24):
        tmp.extend([d[x]['php_file'] for x in d if('hour' in d[x] and d[x]['hour'] == str(i))])
    utils.dump_pickle(cfg.exec_queue,[])
    utils.dump_pickle(cfg.exec_queue,tmp)
    while(True):
        php_file = utils.pop_from_queue(cfg.exec_queue)
        if not os.path.exists(php_file):
            continue
        print(php_file)
        if php_file == -1:
            quit()
        seed_name = php_file.split("/")[-1].split(".")[0]
        #update_data(llm_queue, cov_queue, seed_data)
        cov_eng.load_global_coverage_map_from_file(cfg.collective_map)
        cur_cov = cov_eng.read()
        print('got _cvoerage')
        code = utils.read_file(php_file)
        if "rm " in code or "rmdir" in code or "\'rm" in code or "\"rm" in code or (
                len(code.split("\n")) < 7):
            result = -1
        else:
            result = cov_eng.execute_prog(php_file)
            new_coverage = cov_eng.read() - cur_cov
            print(new_coverage)
            cov_eng.save_global_coverage_map_in_file(cfg.collective_map)
            seed_data = utils.load_pickle(cfg.seed_data)
            seed_data[seed_name]['new_cov'] = new_coverage
            utils.dump_pickle(cfg.seed_data,seed_data) #update data!!!
        room_service(safe_files)

def main():
    exec_loop()

if __name__ == "__main__":
    main()
