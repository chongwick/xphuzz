from phpt_parser import parse_phpt
import traceback
import time
import codecs
import shutil
import time
import re
import secrets
import random
import itertools
import os
import receiver4
import config as cfg
import utils
import pickle
from queue import Queue
from threading import Thread, Lock
from executor import Executor
import errreader as err
from grammar_generators.php_gen import generate_samples
import san
import prompts

fix_prompt = "The response did not follow the ```<code>``` format."


def query_llm(llm, context):
    result = llm.give_context(context)
    if result == "-1" or result == "-2":
        result = llm.give_context(context)
        if result == "-1" or result == "-2":
            return -1
    else:
        return result

def correct_format(llm, result, context):
    llm.change_temperature(0.6)
    if type(result) != str:
        return None
    result = [line + "\n" for line in result.split("\n")]
    #if result[0].strip() == "error":
    #    raise RuntimeError("Restarting LLM")
    i = 0
    code = ""
    while i < 2:
        i += 1
        code_section = False
        for line in result:
            if "```" in line and not(code_section):
                code_section = True
            elif "```" in line and code_section:
                break
            elif code_section:
                code += line
        if code == "":
            utils.log("\n! Re-query: Format Error !\n")
            context.append({'role': 'user', 'content': fix_prompt})
            del(result)
            result = query_llm(llm, context)
            if type(result) != str:
                return None
        else:
            break
    if "<?php" not in code.split("\n")[0]:
        code = "<?php\n" + code + "\n?>"

    return code

def query_loop(llm):
    llm.change_temperature(1)
    out_dir_num = 0
    out_dir = "gen_"+str(out_dir_num)
    while(True):
        name = os.path.join(out_dir,secrets.token_hex(10))
        context = prompts.prompt_it()
        result = query_llm(llm,context)
        context.append({'role':'assistant','content':result})
        code = correct_format(llm, result, context)
        if code == None:
            continue
        else:
            with codecs.open(name,"w",encoding='utf-8',
                             errors='ignore') as f:
                f.write(code)
            utils.add_to_queue(cfg.exec_queue,name)

def main():
    try:
        try:
            role = 'You are a chatting assistant'
            context = [{'role': 'system', 'content': role}]
            #llm = receiver4.LLAMA3_LLM(context)
            llm = receiver4.WHALE_LLM(context)
            query_loop(llm)
        except Exception as e:
            print(traceback.format_exc())
            role = 'You are a chatting assistant'
            context = [{'role': 'system', 'content': role}]
            llm = receiver4.WHALE_LLM(context)
            query_loop(llm)
    except Exception as e:
        print(traceback.format_exc())
        print(e)

if __name__ == "__main__":
    main()
