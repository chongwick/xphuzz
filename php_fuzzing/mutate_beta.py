#This one will run constantly in the background
from generator import generate_samples
import os
import random
import secrets
import config as cfg
import utils
from executor import Executor

def mutate():
    tmp = []
    for i in os.listdir(os.getcwd()):
        if "gen_" in i:
            tmp.append(int(i.split("_")[1]))
    tmp.remove(max(tmp))
    directory = "gen_"+str(max(tmp))
    targets = os.listdir(directory)
    insertion_symbol = "\n<phpfuzz>\n"
    with open("template.php","r") as f:
        template = f.readlines()
    for tar in targets:
        outfile = os.path.join(cfg.mutation_directory,secrets.token_hex(10) + ".php")
        #outfile = os.path.join(outdir,tar+"_M")
        tmp_copy = template.copy()
        with open(os.path.join(directory,tar),"r") as f:
            content = f.readlines()
        insertion_point = random.randint(1, len(content)-1)
        content.insert(insertion_point,insertion_symbol)
        tmp_copy += content[1:]
        tmp_copy = "".join(tmp_copy)
        generate_samples(os.path.dirname(__file__), outfile, tmp_copy, 10)
        utils.add_to_queue(cfg.san_queue, outfile)

def sanitization_loop():
    san_eng = Executor(cfg.sanitizer_engine)
    while(True):
        php_file = utils.pop_from_queue(cfg.san_queue)
        if php_file == -1:
            mutate() #change this
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

def main():
    sanitization_loop()

if __name__ == "__main__":
    main()
