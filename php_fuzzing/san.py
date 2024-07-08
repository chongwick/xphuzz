#This one will run constantly in the background
import os
import random
import secrets
import config as cfg
import utils
import subprocess

def scoring_function(seed_data_point):
    solo_cov = seed_data_point['solo_cov']
    collective_cov = seed_data_point['collective_cov']
    crash = seed_data_point['crash']
    age = 
    solo_cov = seed_data_point['solo_cov']
    solo_cov = seed_data_point['solo_cov']
    seed_data_point["solo_cov": None,                                                           
    "collective_cov": None,                                                        
    "age": None, #AKA token length                                                 
    "crash": None, #AKA token length                                  `

def is_crash(php_file):
    name = php_file.split(".")[0]
    if os.path.exists(php_file):
        return "NC"
    elif os.path.exists(name+".er"):
        return "ER"
    elif os.path.exists(name+".pv"):
        return "PV"


def sanitization_loop():
    #san_eng = Executor(cfg.sanitizer_engine)
    is_error = lambda x: os.path.exists(x+".er")
    is_pot_vul = lambda x: os.path.exists(x+".pv")
    while(True):
        crash = None
        php_file = utils.pop_from_queue(cfg.san_queue)
        seed_name = php_file.split("/")[1].split(".")[0]
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
        if is_crash(php_file) == "ER":
            command = ['bash','./sanitize.sh',os.path.join(os.getcwd(),php_file),'0']
            child = subprocess.run(command, text=True, timeout=120)
            del(command)
            crash = "ER"
            php_file = php_file.split(".")[0]+".er"
            if is_crash(php_file) == "PV":
                crash = "PV"
                php_file = php_file.split(".")[0]+".pv"
        else:
            crash = "NC"

        seed_data = utils.load_pickle("seed_data.pickle")
        seed_data[seed_name]['php_file']=php_file
        seed_data[seed_name]['crash']=crash
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
