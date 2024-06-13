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

if __name__ == "__main__":
    main()
