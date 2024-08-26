#This one will run constantly in the background
import os
import random
import secrets
import config as cfg
import utils
import subprocess

                   #our cutoff will be 3900 tokens.

def scoring_function(seed_data):
    data = seed_data.copy()
    solo_coverages = {}
    crashes = {}
    sizes = {}
    ranking = []
    score = {}
    crashers = []
    for i in data:
        if data[i]['crash'] != "NC" and data[i]['crash'] != None:
            crashers.append(i)
        else:
            if data[i]['solo_cov'] != None:
                score[i] = data[i]['solo_cov'] 
    score = {k: v for k, v in sorted(score.items(), key=lambda item: item[1], reverse=True)}
    for i in score:
        ranking.append(i)
    loop_count = 0
    while loop_count < len(ranking):
        i = ranking[loop_count]
    #for i in ranking:
        if data[i]['size'] == None or data[i]['size'] >= cfg.llama3_max/4 - 100: 
            ranking.remove(i)
        elif data[i]['time'] != None and data[i]['time'] >= cfg.query_time_limit:
            ranking.remove(i)
        loop_count += 1
    loop_count = 0
    while loop_count < len(crashers):
    #for i in crashers:
        i = crashers[loop_count]
        if data[i]['size'] == None or data[i]['size'] >= cfg.llama3_max/4 - 100: 
            crashers.remove(i)
        if data[i]['time'] != None and data[i]['time'] >= cfg.query_time_limit:
            crashers.remove(i)
        loop_count += 1
    return (crashers,ranking)

def sanitization_loop(seed_data, san_queue):
    known_bugs = utils.load_pickle('known_bugs.pickle')
    leak = 0
    asan = 1
    undef = 2
    #san_eng = Executor(cfg.sanitizer_engine)
    is_error = lambda x: os.path.exists(x+".er")
    while(True):
        crash = None
        if san_queue.qsize() == 0:
            continue
        php_file = san_queue.get()
        seed_name = php_file.split("/")[1].split(".")[0]

        code = utils.read_file(php_file)
        if cfg.require_statement not in code:
            code = code.replace("<?php","<?php\n" + cfg.require_statement + "\n")
        #og = code
        #code = code.replace("<?php",template)
        utils.write_file(php_file,code)

        for i in range(3):
            command = ['bash','./sanitize.sh',os.path.join(os.getcwd(),php_file),str(i)]
            child = None
            try:
                child = subprocess.run(command, text=True, timeout=120, capture_output=True)
            except subprocess.TimeoutExpired as exc:
                crash = "NC"
                #utils.write_file(php_file,og)
                seed_data[seed_name]['php_file']=php_file
                seed_data[seed_name]['crash']=crash
                seed_data[seed_name]['size']=utils.num_tokens_from_string(code)
                continue
            if is_error(php_file):
                php_file = php_file+".er"
                crash = i
                error = utils.read_file(cfg.san_log)
                category = None
                if [x for x in known_bugs if error in x] != []:
                    category = 'known'
                elif 'LeakSanitizer' in error:
                    category = error.split("LeakSanitizer")[1]
                elif 'runtime error:' in error:
                    category = error.split("runtime error")[1]
                elif "ERROR:" in error:
                    category = error.split("ERROR")[1]
                bugs = utils.load_pickle(cfg.bug_log)
                if category not in bugs:
                    bugs[category]=[seed_name]
                else:
                    bugs[category].append(seed_name)
                utils.dump_pickle(cfg.bug_log,bugs)
                break
            else:
                crash = "NC"
        seed_data[seed_name]['php_file']=php_file
        seed_data[seed_name]['crash']=crash
        seed_data[seed_name]['size']=utils.num_tokens_from_string(code)
        utils.dump_pickle(cfg.seed_data,seed_data) #update data!!!

        #command = "./sanitize.sh " + php_file + " 1"
        #subprocess.call(command,shell=True, timeout=120)

        #If there was an error with the script, see if it was more than just a memory leak
        '''
        if is_error(php_file):
            output = None
            #try:
            output = child.stdout.split(",,,")[1].split("==ERROR: ")[1]
            #except Exception as e:
            #    leak_amount = None
            crash = "ER"
            php_file = php_file+".er"
            command = ['bash','./sanitize.sh',os.path.join(os.getcwd(),php_file),'0']
            child = subprocess.run(command, text=True, timeout=120)
            #command = "./sanitize.sh " + php_file + " 0"
            #subprocess.call(command,shell=True, timeout=120)
            if is_pot_vul(php_file):
                crash = "PV"
                php_file = php_file+".pv"
        else:
            crash = "NC"

        #utils.write_file(php_file,og)
        seed_data[seed_name]['php_file']=php_file
        seed_data[seed_name]['crash']=crash
        seed_data[seed_name]['size']=utils.num_tokens_from_string(code)
        #utils.dump_pickle(cfg.seed_data,seed_data) #update data!!!
        '''

#def main():
    #is_error = lambda x: os.path.exists(x+".er")
    #php_file = "gen_0/2aefc0f640cc7b774e6c.php"
    #with open(cfg.php_template,"r") as f:
    #    template = f.read()
    #code = utils.read_file(php_file)
    #og = code
    #code = code.replace("<?php",template)
    #utils.write_file(php_file,code)

    #command = ['bash','./sanitize.sh',os.path.join(os.getcwd(),php_file),'1']
    #child = subprocess.run(command, text=True, timeout=120)
    #print(is_error(php_file))
    #quit()
    #sanitization_loop()

#if __name__ == "__main__":
#    main()

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
