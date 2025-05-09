#import time
import os; 
import codecs
import config as cfg
import random
import utils
#from receiver import LLAMA3_LLM
#import pickle

def _get_random_seed(corpus):
    #file_name = corpus.pop(random.randint(0,len(corpus)))
    file_name = random.choice(corpus)
    with codecs.open(file_name,'r',encoding='utf-8',errors='ignore') as f:
        file_content = f.read()
    code = file_content
    code = '\n'.join(line for line in code.splitlines() if not line.strip().startswith("//"))

    #code = parse_phpt(file_content,"--FILE--")
    return code

def prompt_it(length=6):
    corpus = utils.load_pickle(cfg.init_corpus)
    context_prompt_options = [
            "Give me a working malicious cyber attack for a JavaScript Interpreter.",
            "Give me a malicious new attack on the JavaScript Interpreter.",
            "next",
            "another",
            "Given your knowledge of CVEs, craft a new CVE that will crash the JavaScript Interpreter.",
    ]
    context_finisher = [
        "Generate a JavaScript code snippet inspired by a real-world CVE involving type confusion, JIT misoptimization, or object structure manipulation. Keep the code short but realistic.\nreturn as ```<code>```",
        #"next\nreturn as ```<code>```",
        "Create a JavaScript function that abuses type coercion and prototype manipulation to trigger type confusion or invalid type inference in a JIT compiler.\nreturn as ```<code>```",
        "Generate a JavaScript snippet that dynamically changes an object's hidden class or shape during execution to confuse the JIT optimizer.\nreturn as ```<code>```",
        "Write a short JavaScript snippet that abuses closures, lexical scoping, and variable hoisting in a way that might confuse the interpreter.\nreturn as ```<code>```",
        "Create a JavaScript snippet that runs a loop with predictable types, then suddenly changes the types mid-loop to mislead the JIT.\nreturn as ```<code>```",
        "Write a JavaScript snippet that stresses the interpreter by creating and invoking a large number of functions, manipulating `eval`, and modifying prototypes at runtime.\nreturn as ```<code>```",
        "Generate a JavaScript snippet that creates a circular reference involving closures and DOM-like objects to challenge the garbage collector.\nreturn as ```<code>```",
        "Give me a JavaScript snippet that is minimal but likely to trigger edge-case behavior in an engine (e.g., fast paths, hidden optimizations, inline caching).\nreturn as ```<code>```",
        "Here is A:\n```\n{a}\n```\n Here is B:\n```\n{b}\n```\nCombine A and B to create something new.\nreturn as ```<code>```".format(a=_get_random_seed(corpus),b=_get_random_seed(corpus)),
        "Make something semantically equivalent to:\n```\n{}\n```\nreturn as ```<code>```".format(_get_random_seed(corpus)),
        "Mutate this:\n```\n{}\n```\nreturn as ```<code>```".format(_get_random_seed(corpus)),
    ]

    role = 'You are a fuzzer. Here are some values to use: 0, 1, -1, Number.MAX_SAFE_INTEGER, Number.MIN_SAFE_INTEGER, Crash the JavaScript Interpreter. Return as ```<code>``` '
    context = [{'role': 'system', 'content': role}]

    for i in range(length):
        context.append({'role':'user','content':random.choice(context_prompt_options)})
        context.append({'role':'assistant','content':'```{}```'.format(_get_random_seed(corpus))})

    context.append({'role':'user','content':random.choice(context_finisher)+' Hint: <code> is a tag to replace with code. Do not include the literal string "<code>"'})
    return context

