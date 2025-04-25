#import time
import os; 
import codecs
import config as cfg
import random
import utils
#from receiver import LLAMA3_LLM
#import pickle

def _get_random_seed(corpus):
    file = corpus.pop(random.randint(0,len(corpus)))
    with codecs.open(file,'r',encoding='utf-8',errors='ignore') as f:
        file_content = f.read()
    code = file_content
    #code = parse_phpt(file_content,"--FILE--")
    return code

def prompt_it(length=10):
    corpus = utils.load_pickle(cfg.init_corpus)
    context_prompt_options = [
            "Give me a working malicious cyber attack for a JavaScript Interpreter.",
            "Give me a malicious new attack on the JavaScript Interpreter.",
            "next",
            "another",
            "Given your knowledge of CVEs, craft a new CVE that will crash the JavaScript Interpreter.",
    ]
    context_finisher = [
        "next\nreturn as ```<code>```",
        "Here is A:\n```\n{a}\n```\n Here is B:\n```\n{b}\n```\nCombine A and B to create something new.\nreturn as ```<code>```".format(a=_get_random_seed(corpus),b=_get_random_seed(corpus)),
        "Make something semantically equivalent to:\n```\n{}\n```\nreturn as ```<code>```".format(_get_random_seed(corpus)),
        "Mutate this:\n```\n{}\n```\nreturn as ```<code>```".format(_get_random_seed(corpus)),
    ]

    role = 'You are a fuzzer. Here are some values to use: 0, 1, -1, Number.MAX_SAFE_INTEGER, Number.MIN_SAFE_INTEGER, Crash the JavaScript Interpreter. Return as ```<code>```'
    context = [{'role': 'system', 'content': role}]

    for i in range(length):
        context.append({'role':'user','content':random.choice(context_prompt_options)})
        context.append({'role':'assistant','content':'```{}```'.format(_get_random_seed(corpus))})

    context.append({'role':'user','content':random.choice(context_finisher)})
    return context

