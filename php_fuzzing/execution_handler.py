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

def exec_loop():
    seed_data = None
    llm_queue = None
    exec_queue = None
    #safe_files = utils.load_pickle(cfg.safe_files)
    while(True):
        php_file = utils.pop_from_queue(cfg.exec_queue)
        if php_file == -1:
            continue
        else:
            with codecs.open(php_file,'r',encoding='utf-8',errors='ignore') as f:
                code = f.read()
            if "rm " in code or "rmdir" in code or "\'rm" in code or "\"rm" in code or (
                len(code.split("\n")) < 7):
                continue
            #sanitizeeeee
            crash = None
            is_error = lambda x: os.path.exists(x+".er")
            is_trash = lambda x: os.path.exists(x+".tr")

            command = ['bash','./sanitize.sh',os.path.join(os.getcwd(),php_file)]

            child = None
            try:
                child = subprocess.run(command,
                                       text=True,
                                       timeout=40,
                                       capture_output=True)
            except subprocess.TimeoutExpired as exc:
                valid = False
            if is_error(php_file):
                php_file = php_file+".er"
                crash = None
                error = None
                #category = None
                if "exit(" in code:
                    crash = "NC"
                    error = 'exit'
                else:
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
            else:
                if is_trash(php_file):
                    os.remove(php_file+".tr")
                else:
                    try:
                        os.remove(php_file)
                    except Exception as e: #I'll handle this eventually
                        pass


def main():
    exec_loop()

if __name__ == "__main__":
    main()
