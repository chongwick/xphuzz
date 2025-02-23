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

def update_data(llm_queue, cov_queue, seed_data, san_queue=None):
    utils.dump_pickle(cfg.llm_queue, list(llm_queue.queue))
    utils.dump_pickle(cfg.cov_queue, list(cov_queue.queue))
    if san_queue != None:
        utils.dump_pickle(cfg.san_queue, list(san_queue.queue))
    utils.dump_pickle(cfg.seed_data, seed_data)

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

def generate_config():

    def _random_jit_mode():
        jit_mode = choice(['1111','1215','1211','1213','1254','1255','1201','1202','1205','1101','1103','1105','1231','1235','1011','1015'])
        #jit_mode = choice(['1254','1205'])
        jit_ini = '''
opcache.enable=1
opcache.enable_cli=1
opcache.jit=''' + jit_mode
        return jit_ini

    def _get_random_config():
        config_options = {
            "precision": choice([10, 12, 13, 14, 17]),
            "serialize_precision": choice([5, 10, 14, 15, 75, -1]),
            "memory_limit": choice(["2M", "33M", "16M", "20M", "32M", "100M", "256M", "512M", "5M", "8M", "128M", "6G", "-1"]),
            "post_max_size": choice(["1", "1M", "1024"]),
            "max_input_vars": choice([1, 4, 5, 10, 100, 1000]),
            "max_execution_time": choice([0, 1, 2, 10, 12, 60]),
            "default_charset": choice(["cp932", "big5", "ISO-8859-1", "UTF-8", "", "cp874", "cp936", "cp1251", "cp1252", "cp1253", "cp1254", "cp1255", "cp1256"]),
            "short_open_tag": choice(["on", "off", 1]),
            "auto_globals_jit": choice([0, 1]),
            "expose_php": choice([0, "On"]),
            "implicit_flush": choice([0, 1]),
            "allow_url_include": choice([0, 1]),

            # Timezone settings
            "date.timezone": choice([
                "Europe/London", "UTC", "Atlantic/Azores", "GMT", "America/Los_Angeles", "Asia/Singapore",
                "Asia/Chongqing", "Europe/Amsterdam", "Europe/Berlin", "Europe/Paris", "America/New_York",
                "America/Montreal", "America/Sao_Paulo", "America/Vancouver", "America/Mendoza", "Europe/Rome",
                "GMT0", "Mars/Utopia_Planitia", "Incorrect/Zone"
            ]),

            # Opcache settings
            "opcache.enable": choice([0, 1]),
            "opcache.enable_cli": choice([0, 1]),
            "opcache.preload": "{PWD}/" + choice([
                "preload_undef_const_2.inc", "preload_variance_ind.inc", "preload_inheritance_error_ind.inc",
                "preload_ind.inc", "preload_bug81256.inc", "preload_user.inc"
            ]),
            "opcache.jit": choice([0, 1205, 1235, 1255]),
            "opcache.jit_buffer_size": choice(["1M", "128M", "0"]),
            "opcache.jit_blacklist_root_trace": choice(["16", "255"]),
            "opcache.jit_blacklist_side_trace": choice(["8", "255"]),
            "opcache.jit_max_loop_unrolls": choice(["8", "10"]),
            "opcache.jit_max_recursive_calls": choice(["2", "10"]),
            "opcache.jit_max_recursive_returns": choice(["2", "4"]),
            "opcache.jit_max_polymorphic_calls": choice(["2", "1000"]),
            "opcache.file_update_protection": choice([0, 2]),
            "opcache.optimization_level": choice([-1, 0, 0x7fffffff, 0x4ff, 0x7FFFBFFF]),
            "opcache.memory_consumption": choice([7, 64]),
            "opcache.max_accelerated_files": choice([10, 1000000]),
            "opcache.revalidate_freq": choice([0, 60]),
            "opcache.validate_timestamps": choice([0, 1]),
            "opcache.interned_strings_buffer": choice([-1, 16, 131072]),

            # Session settings
            "session.save_handler": choice(["files", "non-existent", "qwerty"]),
            "session.auto_start": choice([0, 1]),
            "session.use_cookies": choice([0, 1]),
            "session.cookie_httponly": choice([0, "TRUE"]),
            "session.cookie_secure": choice([0, "TRUE"]),
            "session.use_strict_mode": choice([0, 1]),
            "session.use_trans_sid": choice([0, 1]),
            "session.gc_maxlifetime": choice([300, 0]),
            "session.upload_progress.enabled": choice([0, 1]),
            "session.gc_probability": choice([0, 1]),
            "session.sid_length": choice([32]),

            # Error reporting settings
            "error_reporting": choice([0, -1, 1, 8191, 14335, 2039, 2047, "E_ALL", "E_ALL^E_NOTICE", "E_ALL & ~E_DEPRECATED", "E_ALL & ~E_WARNING & ~E_NOTICE", "E_ALL & ~E_WARNING", "E_ALL & ~E_DEPRECATED", "E_ALL & E_NOTICE | E_PARSE ^ E_DEPRECATED & ~E_WARNING | !E_ERROR"]),

            # Mail settings
            "sendmail_path": "{MAIL:{PWD}/" + choice([
                "mb_send_mail04.eml", "mailBasic7.out", "gh8086.eml", "mb_send_mail03.eml", "gh7902.eml"
            ]) + "}"
        }

        # Randomly select one key-value pair from the config options
        random_key = choice(list(config_options.keys()))
        return f"{random_key}={config_options[random_key]}"

    ini = _get_random_config()
    if choice([True,False]):
        ini += _random_jit_mode()
    return ini

#There are multiple execution loops but only one llm loop, use the llm loop for the new gen
def exec_loop():
    seed_data = None
    llm_queue = None
    exec_queue = None
    #safe_files = utils.load_pickle(cfg.safe_files)
    safe_files = os.listdir(os.path.dirname(os.path.realpath(__file__)))
    cov_eng = Executor(cfg.coverage_engine)
    partner_died = lambda : int(utils.read_file(cfg.time_file)) == -1
    while(True):
        if partner_died():
            quit()
        php_file = utils.pop_from_queue(cfg.exec_queue)
        instructions = None
        if choice([False,False,True]):
            instructions = " ".join(["-d " + i for i in generate_config().split("\n")])
        if php_file == -1:
            continue
        #file_instr = utils.load_pickle(cfg.file_instr)
        seed_name = php_file.split("/")[-1].split(".")[0]
        hour = -1

        #if seed_name in file_instr and file_instr[seed_name] != "":
        #    is_instructions = True
        #    instructions = file_instr[seed_name]
        #    with codecs.open(os.path.join(cfg.inidir,seed_name),"w",encoding='utf-8',
        #         errors='ignore') as f:
        #        f.write(instructions)

        #update_data(llm_queue, cov_queue, seed_data)
        print("mapping: " + php_file)
        cov_eng.load_global_coverage_map_from_file(cfg.base_map)
        code = utils.read_file(php_file)

        for line in code.split("\n"):
            first_word = line.strip().split(" ")[0]
            if first_word == "require" or first_word == "require_once":
                include_file = None
                for word in line.split(" "):
                    if ".inc" in word:
                        include_file = word
                        if "'" in word:
                            if "/" in word:
                                include_file = "'" + cfg.includes + word.split("/")[-1]
                            else:
                                include_file = "'" + cfg.includes + word.split("/")[0]
                        else:
                            if "/" in word:
                                include_file = '"' + cfg.includes + word.split("/")[-1]
                            else:
                                include_file = '"' + cfg.includes + word.split("/")[0]
                        code.replace(line, "require " + include_file + "\n")

        '''if "require '" in code:
            can also be require "
            need to split code by lines to find require statement to patch'''
            #code = code.replace("require '", "require '{}".format(cfg.includes))

        if cfg.require_statement not in code:
            code = code.replace("<?php","<?php\n" + cfg.require_statement + "\n")

        result = None
        if "rm " in code or "rmdir" in code or "\'rm" in code or "\"rm" in code or (
                len(code.split("\n")) < 7):
            result = -1
        else:
            utils.write_file(php_file,code)
            if instructions != None:
                result = cov_eng.execute_prog(php_file,instructions)
                #result = cov_eng.execute_prog(php_file, "-c {}".format(os.path.join(cfg.inidir,seed_name)))
            else:
                result = cov_eng.execute_prog(php_file)
            current_files = os.listdir(
                    os.path.dirname(os.path.realpath(__file__)))
            tmp = [i for i in current_files if (
                i not in safe_files and
                "blank.php" not in i and
                "gen_" not in i and
                "boot_" not in i)]
            if len(tmp) > 100:
                result = -1
        if result == -1:
            seed_data = utils.load_pickle(cfg.seed_data)
            seed_data[seed_name]['valid'] = False
            utils.dump_pickle(cfg.seed_data,seed_data) #update data!!!
            continue
        if err.is_error(result):
            fix_query = prompts.fix(code, err.parse_error(result, php_file))
            fix_req_name = os.path.join(cfg.llm_requests,
                                        php_file.split("/")[-1].split(".")[0]+"_f")
            utils.dump_pickle(fix_req_name, fix_query)
            utils.add_to_queue(cfg.llm_queue, fix_req_name)
        else:
            #sanitizeeeee
            print('sanitizing')
            start_time = int(utils.read_file(cfg.time_file))
            if start_time == -1:
                quit()
            else:
                #hour = int((time.time() - start_time) // 1800) #use if double gpu
                hour = int((time.time() - start_time) // 3600)
            valid = True
            solo_coverage = None
            crash = None
            is_error = lambda x: os.path.exists(x+".er")
            is_trash = lambda x: os.path.exists(x+".tr")
            if result == 'seg':
                solo_coverage = 1
            else:
                solo_coverage = cov_eng.read()
                #remap
                #cov_eng.load_global_coverage_map_from_file(cfg.collective_map)
                #cur_cov = cov_eng.read()
                #result = cov_eng.execute_prog(php_file)
                #new_coverage = cov_eng.read() - cur_cov
                #cov_eng.save_global_coverage_map_in_file(cfg.collective_map)

            for i in range(3):
                command = ['bash','./sanitize.sh',os.path.join(os.getcwd(),php_file),str(i)]
                child = None
                try:
                    child = subprocess.run(command,
                                           text=True,
                                           timeout=40,
                                           capture_output=True)
                except subprocess.TimeoutExpired as exc:
                    valid = False
                    #These take too long. just kill them
                    #crash = "NC"
                    ##utils.write_file(php_file,og)
                    #seed_data[seed_name]['php_file']=php_file
                    #seed_data[seed_name]['crash']=crash
                    #seed_data[seed_name]['size']=utils.num_tokens_from_string(code)
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
                            error = error.split("/dan/")[1].split(" ")[0]
                        except Exception as e:
                            error = error
                    #if 'LeakSanitizer' in error:
                    #    category = error.split("LeakSanitizer")[1]
                    #elif 'runtime error:' in error:
                    #    category = error.split("runtime error")[1]
                    #elif "ERROR:" in error:
                    #    category = error.split("ERROR")[1]
                    bugs = utils.load_pickle(cfg.bug_log)
                    if error not in bugs:
                        bugs[error]=[seed_name + instructions]
                    else:
                        bugs[error].append(seed_name)
                    utils.dump_pickle(cfg.bug_log,bugs)
                    break
                else:
                    crash = "NC"
            seed_data = utils.load_pickle(cfg.seed_data)

            if is_trash(php_file):
                php_file = php_file+".tr"
                os.rename(php_file,php_file.split(".tr")[0])
                seed_data[seed_name]['valid'] = True
                seed_data[seed_name]['hour'] = hour
                seed_data[seed_name]['solo_cov'] = solo_coverage
                #seed_data[seed_name]['new_cov'] = new_coverage
                seed_data[seed_name]['php_file'] = php_file.split(".tr")[0]
                seed_data[seed_name]['crash']="trash"
                seed_data[seed_name]['size']=utils.num_tokens_from_string(code)
                #del(seed_data[seed_name])
            else:
                os.rename(php_file,php_file.split(".er")[0])
                seed_data[seed_name]['valid'] = valid
                seed_data[seed_name]['hour'] = hour
                seed_data[seed_name]['solo_cov'] = solo_coverage
                #seed_data[seed_name]['new_cov'] = new_coverage
                seed_data[seed_name]['php_file']=php_file.split(".er")[0]
                seed_data[seed_name]['crash']=crash
                seed_data[seed_name]['size']=utils.num_tokens_from_string(code)
            #if is_instructions:
            #    os.remove(os.path.join(cfg.inidir,seed_name))
            utils.dump_pickle(cfg.seed_data,seed_data) #update data!!!
        room_service(safe_files)

def main():
    exec_loop()

if __name__ == "__main__":
    main()
