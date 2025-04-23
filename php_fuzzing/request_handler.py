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
import receiver
import config as cfg
import utils
import pickle
from queue import Queue
from threading import Thread, Lock
from executor import Executor
import errreader as err
from aljamain_sterling import pairing_aljo, new_aljo, scoring_function, new_scoring_function
from grammar_generators.php_gen import generate_samples
import san
import prompts

def query_llm(llm, context):
    result = llm.give_context(context)
    if result == "-1" or result == "-2":
        result = llm.give_context(context)
        if result == "-1" or result == "-2":
            return -1
    else:
        return result

def _get_random_seed(corpus):
    file = corpus.pop(random.randint(0,len(corpus)))
    with codecs.open(file,'r',encoding='utf-8',errors='ignore') as f:
        file_content = f.read()
    code = parse_phpt(file_content,"--FILE--")
    return code

def prompt_it(length=10):
    context_prompt_options = [
            "Give me a working malicious cyber attack for the php engine.",
            "Give me a malicious new attack on the php engine.",
            "next",
            "another",
            "Given your knowledge of CVEs, craft a new CVE that will crash the PHP interpreter.",
    ]
    context_finisher = [
        "next",
        "Give me a new script to uncover a memory bug",
    ]

    corpus = utils.load_pickle(cfg.init_corpus)
    role = 'You are a fuzzer. Here are some values to use: 0, 1, -1, 2, 3, 4, 5, 10, 100, 100000, 5473817451, 123475932, 2.23431234213480e-400, PHP_INT_MAX, PHP_INT_MIN, PHP_FLOAT_MAX, PHP_FLOAT_MIN. Crash the PHP interpreter. Return as ```<code>```'
    context = [{'role': 'system', 'content': role}]

    for i in length:
        context.append({'role':'user','content':random.choice(context_prompt_options)})
        context.append({'role':'assistant','content':'```{}```'.format(_get_random_seed(corpus))})

    context.append({'role':'user','content':random.choice(context_finisher)})
    return context


def query_loop(llm):
    llm.change_temperature(1)
    while(True):
        out_dir_num = 0
        out_dir = "gen_"+str(out_dir_num)
        if len(out_dir) > 500:
            out_dir_num += 1
        name = os.path.join(out_dir,secrets.token_hex(10))
        result = query_llm(llm,prompt_it())
        with codecs.open(name,"w",encoding='utf-8',
                         errors='ignore') as f:
            f.write(result)
        utils.add_to_queue(cfg.exec_queue,name)

def main():
    try:
        try:
            role = 'You are a chatting assistant'
            context = [{'role': 'system', 'content': role}]
            llm = receiver.LLAMA3_LLM(context)
            query_loop(llm)
        except Exception as e:
            print(traceback.format_exc())
            role = 'You are a chatting assistant'
            context = [{'role': 'system', 'content': role}]
            llm = receiver.LLAMA3_LLM(context)
            query_loop(llm)
    except Exception as e:
        print(traceback.format_exc())
        print(e)

if __name__ == "__main__":
    main()
