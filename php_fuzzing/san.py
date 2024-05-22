import os
import config as cfg
import utils
import pickle
from executor import Executor
import errreader as err

def main():
    san_eng = Executor(cfg.sanitizer_engine)

    while(True):
        php_file = utils.pop_from_queue(cfg.san_queue)
        if php_file == -1:
            continue
        result = san_eng.execute_prog(php_file)
        if result == -1:
            print("Potential Vuln: " + php_file)
        elif "Sanitizer" in result:
            print("Vuln: " + php_file)

if __name__ == "__main__":
    main()
