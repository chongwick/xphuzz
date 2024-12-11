import shutil
import os
import config as cfg
import utils
from executor import Executor 
import errreader as err
import prompts
import subprocess
import secrets
secrets.token_hex(10)

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

    map_file = utils.load_pickle("map.pickle")

    g = [i for i in utils.load_pickle("allphptests.pickle")[0] if ".phpt" in i]
    utils.dump_pickle(cfg.exec_queue,[])
    utils.dump_pickle(cfg.exec_queue,g)

    while(True):
        php_file = None
        is_good_file = False
        code = ""
        instructions = ""
        while(not is_good_file):
            php_file = utils.pop_from_queue(cfg.exec_queue)
            with open(php_file,'r') as f:
                code = f.read()
            if "--FILE--" in code:
                good_file = True

        if "INI" in code:
            instructions = code.split("INI")[1].split("\n")[1]
        code = "<?php\n" + code.split("<?php\n")[1]
        code = code.split("?>")[0] + "\n?>"

        for line in code.split("\n"):
            first_word = line.split(" ")[0]
            if first_word == "require" or first_word == "require_once":
                include_file = None
                for word in line.split(" "):
                    if ".inc" in word:
                        include_file = word
                        if "'" in word:
                            if "/" in word:
                                include_file = "'" + cfg.includes + word.split("/")[1]
                            else:
                                include_file = "'" + cfg.includes + word.split("/")[0]
                        else:
                            if "/" in word:
                                include_file = '"' + cfg.includes + word.split("/")[1]
                            else:
                                include_file = '"' + cfg.includes + word.split("/")[0]
                        code.replace(line, "require " + include_file + "\n")
                
        seed_name = str(secrets.token_hex(10))
        with open(seed_name,"w") as f:
            f.write(code)
        if instructions != "":
            with open(os.path.join(cfg.inidir,seed_name),"w") as f:
                f.write(instructions)

        #is_instructions = False
        #if php_file == -1:
        #    quit()
        #file_instr = utils.load_pickle(cfg.file_instr)
        #seed_name = php_file.split("/")[-1].split(".")[0]


        #if seed_name in file_instr and file_instr[seed_name] != "":
        #    is_instructions = True
        #    instructions = file_instr[seed_name]
        #    with open(os.path.join(cfg.inidir,seed_name),"w") as f:
        #        f.write(instructions)

        #update_data(llm_queue, cov_queue, seed_data)
        print("mapping: " + php_file)
        cov_eng.load_global_coverage_map_from_file(cfg.base_map)

        result = None
        if "rm " in code or "rmdir" in code or "\'rm" in code or "\"rm" in code or (
                len(code.split("\n")) < 7):
            result = -1
        else:
            #utils.write_file(php_file,code)
            if instructions != "":
                result = cov_eng.execute_prog(php_file, "-c {}".format(os.path.join(cfg.inidir,seed_name)))
            else:
                result = cov_eng.execute_prog(php_file)
        if result == -1:
            continue
        if err.is_error(result):
            continue
        else:
            solo_coverage = cov_eng.read()
            ##sanitizeeeee
            #print('sanitizing')
            #valid = True
            #solo_coverage = None
            #crash = None
            #is_error = lambda x: os.path.exists(x+".er")
            #is_trash = lambda x: os.path.exists(x+".tr")
            #if result == 'seg':
            #    solo_coverage = 1
            #else:
            #    solo_coverage = cov_eng.read()
            #    #remap
            #    #cov_eng.load_global_coverage_map_from_file(cfg.collective_map)
            #    #cur_cov = cov_eng.read()
            #    #result = cov_eng.execute_prog(php_file)
            #    #new_coverage = cov_eng.read() - cur_cov
            #    #cov_eng.save_global_coverage_map_in_file(cfg.collective_map)

            #for i in range(3):
            #    command = ['bash','./sanitize.sh',os.path.join(os.getcwd(),php_file),str(i)]
            #    child = None
            #    try:
            #        child = subprocess.run(command,
            #                               text=True,
            #                               timeout=40,
            #                               capture_output=True)
            #    except subprocess.TimeoutExpired as exc:
            #        valid = False
            #        #These take too long. just kill them
            #        #crash = "NC"
            #        ##utils.write_file(php_file,og)
            #        #seed_data[seed_name]['php_file']=php_file
            #        #seed_data[seed_name]['crash']=crash
            #        #seed_data[seed_name]['size']=utils.num_tokens_from_string(code)
            #        break
            #    if is_error(php_file):
            #        php_file = php_file+".er"
            #        crash = None
            #        error = None
            #        #category = None
            #        if "exit(" in code:
            #            crash = "NC"
            #            error = 'exit'
            #        else:
            #            crash = i
            #            error = utils.read_file(cfg.san_log)
            #            #category = None
            #            try:
            #                error = error.split("/dan/")[1].split(" ")[0]
            #            except Exception as e:
            #                error = error
            #        #if 'LeakSanitizer' in error:
            #        #    category = error.split("LeakSanitizer")[1]
            #        #elif 'runtime error:' in error:
            #        #    category = error.split("runtime error")[1]
            #        #elif "ERROR:" in error:
            #        #    category = error.split("ERROR")[1]
            #        bugs = utils.load_pickle(cfg.bug_log)
            #        if error not in bugs:
            #            bugs[error]=[seed_name]
            #        else:
            #            bugs[error].append(seed_name)
            #        utils.dump_pickle(cfg.bug_log,bugs)
            #        break
            #    else:
            #        crash = "NC"
            #seed_data = utils.load_pickle(cfg.seed_data)

            #if is_trash(php_file):
            #    php_file = php_file+".tr"
            #    os.rename(php_file,php_file.split(".tr")[0])
            #    seed_data[seed_name]['valid'] = False
            #    seed_data[seed_name]['solo_cov'] = solo_coverage
            #    #seed_data[seed_name]['new_cov'] = new_coverage
            #    seed_data[seed_name]['php_file'] = php_file.split(".tr")[0]
            #    seed_data[seed_name]['crash']="trash"
            #    seed_data[seed_name]['size']=utils.num_tokens_from_string(code)
            #    #del(seed_data[seed_name])
            #else:
            #    os.rename(php_file,php_file.split(".er")[0])
            #    seed_data[seed_name]['valid'] = valid
            #    seed_data[seed_name]['solo_cov'] = solo_coverage
            #    #seed_data[seed_name]['new_cov'] = new_coverage
            #    seed_data[seed_name]['php_file']=php_file.split(".er")[0]
            #    seed_data[seed_name]['crash']=crash
            #    seed_data[seed_name]['size']=utils.num_tokens_from_string(code)
            if _instructions != "":
                os.remove(os.path.join(cfg.inidir,seed_name))
            #utils.dump_pickle(cfg.seed_data,seed_data) #update data!!!
            map[seed_name] = solo_coverage
            os.remove(seed_name)
        room_service(safe_files)

def main():
    exec_loop()

if __name__ == "__main__":
    main()
