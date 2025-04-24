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

def exec_loop():
    seed_data = None
    llm_queue = None
    exec_queue = None
    #safe_files = utils.load_pickle(cfg.safe_files)
    safe_files = os.listdir(os.path.dirname(os.path.realpath(__file__)))
    cov_eng = Executor(cfg.coverage_engine)
    while(True):
        php_file = utils.pop_from_queue(cfg.exec_queue)
        with codecs.open(php_file,'r',encoding='utf-8',errors='ignore') as f:
            code = f.read()
        if php_file == -1:
            continue
        else:
            #sanitizeeeee
            print('sanitizing')
            crash = None
            is_error = lambda x: os.path.exists(x+".er")
            is_trash = lambda x: os.path.exists(x+".tr")

            for i in range(2):
                command = ['bash','./sanitize.sh',os.path.join(os.getcwd(),php_file),str(i),cfg.sanitizer_engine]

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
                    if "exit(" in code:
                        crash = "NC"
                        error = 'exit'
                    else:
                        crash = i
                        error = utils.read_file(cfg.san_log)
                        #category = None
                        try:
                            error = error.split("/w023dtc/")[1].split(" ")[0] #change this
                        except Exception as e:
                            error = error
                    bugs = utils.load_pickle(cfg.bug_log)
                    if error not in bugs:
                        bugs[error] = [php_file]
                    else:
                        bugs[error].append(php_file)
                    utils.dump_pickle(cfg.bug_log,bugs)
                    break
                else:
                    crash = "NC"

        room_service(safe_files)

def main():
    exec_loop()

if __name__ == "__main__":
    main()
