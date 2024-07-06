#This one will run constantly in the background
import os
import random
import secrets
import config as cfg
import utils
import subprocess

def sanitization_loop():
    #san_eng = Executor(cfg.sanitizer_engine)
    is_error = lambda x: os.path.exists(x+".er")
    is_pot_vul = lambda x: os.path.exists(x+".pv")
    while(True):
        php_file = utils.pop_from_queue(cfg.san_queue)
        if php_file == -1:
            continue

        with open(cfg.php_template,"r") as f:
            template = f.read()
        code = utils.read_file(php_file)
        og = code
        code = code.replace("<?php",template)
        utils.write_file(php_file,code)

        command = ['bash','./sanitize.sh',os.path.join(os.getcwd(),php_file),'1']
        child = subprocess.run(command, text=True, timeout=120)
        del(command)

        #If there was an error with the script, see if it was more than just a memory leak
        if is_error(php_file):
            command = ['bash','./sanitize.sh',os.path.join(os.getcwd(),php_file),'0']
            child = subprocess.run(command, text=True, timeout=120)
            del(command)

        utils.write_file(php_file,og)

def main():
    sanitization_loop()

if __name__ == "__main__":
    main()

##result = san_eng.execute_prog(php_file)
#if result == -1:
#    print("really suspicious:", php_file)
#    continue
#if san_eng.ret_code != 0:
#    if san_eng.ret_code == 255:
#        print("EXCEPTION ", php_file)
#        #os.remove(php_file)
#    elif san_eng.ret_code == 124:
#        print("TIMEOUT ", php_file)
#        #os.remove(php_file)
#    elif san_eng.ret_code == 153:
#        print("MEMORY LEAK", php_file)
#        #os.remove(php_file)
#    elif "Allowed memory size of" in result:
#        print("OOM", php_file)
#        #os.remove(php_file)
#    elif "AddressSanitizer failed to allocate" in result:
#        print("OOM", php_file)
#        #os.remove(php_file)
#    elif "Assertion" in result:
#        print("ASSERTION", php_file)
#        #os.remove(php_file)
#    else:
#        print("POTENTIAL VULN", php_file, san_eng.ret_code)
#        os.rename(php_file, os.path.join("pot_vulns",php_file.split("/")[1]))
#else:
#    pass
#    #print("OK")
#    #os.remove(php_file)
#
