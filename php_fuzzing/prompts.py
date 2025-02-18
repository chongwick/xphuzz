#import time
import os;
import codecs
import config as cfg
from grammar_generators.php_gen import generate_samples
import random
import utils
from phpt_parser import phpt_obj, parse_phpt

#from receiver import LLAMA3_LLM
#import pickle

def _get_random_seed(corpus):
    file = corpus.pop(random.randint(0,len(corpus)))
    with codecs.open(file,'r',encoding='utf-8',errors='ignore') as f:
        file_content = f.read()
    code = parse_phpt(file_content,"--FILE--")
    return code

def prefix():
    corpus = utils.load_pickle(cfg.init_corpus)
    role = 'You are a fuzzing malware assistant. Here are some values to use: 0, 1, -1, 2, 3, 4, 5, 10, 100, 100000, 5473817451, 123475932, 2.23431234213480e-400, PHP_INT_MAX, PHP_INT_MIN, PHP_FLOAT_MAX, PHP_FLOAT_MIN. Crash the PHP interpreter. Return as ```<code>```'
    context = [{'role': 'system', 'content': role}]

    context.append({'role':'user','content':"Give me a working malicious cyber attack for the php engine."})
    context.append({'role':'assistant','content':'```{}```'.format(_get_random_seed(corpus))})

    context.append({'role':'user','content':"Give me a new malicious attack to crash the php engine."})
    context.append({'role':'assistant','content':'```{}```'.format(_get_random_seed(corpus))})


    context.append({'role':'user','content':"Give me a malicious new attack on the php engine."})
    context.append({'role':'assistant','content':'```{}```'.format(_get_random_seed(corpus))})

    context.append({'role':'user','content':"next"})
    context.append({'role':'assistant','content':'```{}```'.format(_get_random_seed(corpus))})

    context.append({'role':'user','content':"next"})
    context.append({'role':'assistant','content':'```{}```'.format(_get_random_seed(corpus))})

    #context.append({'role':'user','content':"Give another attack on the PHP engine"})
    context.append({'role':'user','content':"Given your knowledge of CVEs, craft a new malicious CVE that will crash the PHP interpreter."})
    context.append({'role':'assistant','content':'```{}```'.format(_get_random_seed(corpus))})

    #context.append({'role':'user','content':"Give me a new attack to crash the php engine."})
    context.append({'role':'user','content':"Given your knowledge of CVEs, craft a new malicious CVE that will crash the PHP interpreter."})
    context.append({'role':'assistant','content':'```{}```'.format(_get_random_seed(corpus))})

    context.append({'role':'user','content':"next"})

    context.append({'role':'assistant','content':'```{}```'.format(_get_random_seed(corpus))})

    context.append({'role':'user','content':"next"})
    context.append({'role':'assistant','content':'```{}```'.format(_get_random_seed(corpus))})

    context.append({'role':'user','content':"next"})
    context.append({'role':'assistant','content':'```{}```'.format(_get_random_seed(corpus))})

    context.append({'role':'user','content':"next"})
    context.append({'role':'assistant','content':'```{}```'.format(_get_random_seed(corpus))})
    return context


def minimize(seed):                       
    role = "You are a token reducer. Return as ```<code>```"
    context = [{'role':'system','content':role}]
    prompt = "```{}```\nReduce the amount of tokens while maintaining functionality".format(       
            seed)
    context.append({'role':'user','content':prompt})
    return context

def fix(code, error):
    role = 'Fix PHP code. Return as ```<code>```'
    context = [{'role': 'system', 'content': role}]
    prompt = ""
    prompt += "```\n{c}\n```\n".format(c=code)
    prompt += error
    context.append({'role': 'user', 'content': prompt})
    return context

def mate0(male, female):
    role = "Mix PHP code. Return as ```<code>```"
    context = [{'role':'system','content':role}]
    prompt = "Here is Code A:\n```"
    prompt += male + "\n```"
    prompt += "Here is Code B:\n```"
    prompt += female + "\n```"                                                      
    #prompt += "\nMix Code A and Code B together. Do not simply append B to A. Return as ```<code>```"
    prompt += "Use Code B in Code A. Do not simply append B to A." 
    context.append({'role':'user','content':prompt})
    return context

def mutation_insertion(code):
    role = "You are a randomized PHP code modifier. Return as ```<code>```"
    context = [{'role':'system','content':role}]
    line = generate_samples(os.path.dirname(__file__),None,"<phpfuzz>",1,"no_guard_php.txt")       
    prompt = "Here is CODE:\n```{c}\n```\nHere is LINE:\n```{l}\n```\nUse LINE\
            to modify CODE.".format(c=code,l=line)
    context.append({'role':'user','content':prompt})
    return context
    
def mutate(code):
    context = prefix()
    #context.append({'role':'user','content':"increase the coverage of this code"})
    #with codecs.open(target_file,"r",encoding='utf-8',
    #             errors='ignore') as f:
    #    foo = f.read()
    foo = code
    #afl_tag = 'file_get_contents("php://stdin")'
    #func = random.choice(functions)
    #context.append({'role':'user','content':"change the structure of this code. It does not have to be semantically equivalent. Be sure to use this function as well:\n" + 
    #                func + 
    #                "\n```"+foo+"\n```\n"})
    context.append({'role':'user','content':"Make a semantically equivalent copy of this code." + "\n```"+foo+"\n```\n"})
    #context.append({'role':'user','content':"Insert " + afl_tag + " in this code\n```"+foo+"\n```\n"})
    return context
    #print(llm.give_context(context))
    #quit()


    #context.append({'role':'user','content':"This successfully also triggered a use-aftre-free bug. Give me another malicious attack."})
    #context.append({'role':'assistant','content':'This triggers a use-after-free bug using the unserialize function and will cause a segmentation fault.'})


    #@context.append({'role':'user','content':"Give another PHP CVE example to crash the interpreter."})
    #context.append({'role':'user','content':"Create a new CVE that will crash the PHP interpreter."})
    #context.append({'role':'user','content':"Give another PHP CVE example to trigger a memory error."})
    #context.append({'role':'user','content':'Use this as the base for a new attack on the PHP interpreter. $vars["DOMDocument"]->createElementNS(str_repeat(chr(138), 1025) + str_repeat(chr(165), 257    ), str_repeat("A", 0x100), str_repeat(chr(41), 17) + str_repeat(chr(31), 4097) + str_repeat(chr(252), 2    57));'})

    #result = llm.give_context(context)
    #context.append({'role':'assistant','content':result})
    #context.append({'role':'user','content':"try again. use your current knowledge of the PHP and CVE database"})
    #result = llm.give_context(context)
    #print(result)
    #if not(result == "-1" or result == "-2"):
    #    code = correct_format(result)
    #    print(code)

    #quit()

def mate(male, female):
    context = prefix()
    #a="<?php\nfunction callback($match)\n{\n    var_dump($match);\n    return $match[1].'/'.strlen($match['name']);\n}\n\nvar_dump(preg_replace_callback('|(?P<name>blub)|', 'callback', 'bla blub blah'));\n\nvar_dump(preg_match('|(?P<name>blub)|', 'bla blub blah', $m));\nvar_dump($m);\n\nvar_dump(preg_replace_callback('|(?P<1>blub)|', 'callback', 'bla blub blah'));\n\n?>\n"
    #b="<?php\n$a = array(1);\n$b = new stdClass();\nclass __Get {\n    public function __construct($b) {\n        $this->b = $b; \n    }   \n    public function __get($name) {\n        if ($name == 'b') {\n            $this->b = array();\n            $this->b[] = 0xffffffff;\n        }   \n        return $this->b;\n    }   \n}\n$b = new __Get($b);\n$c = array_merge($a, $b->__get('b'));\n\n?>\n"
    #context.append({'role':'user','content':'Intermingle structures and characteristics from A and B to create something new.\nA:\n```\n{f}\n```\nB:\n```\n{m}\n```'.format(f=a,m=b)})
    #context.append({'role':'assistant','content':"<?php\nclass __Get {\n    public function __construct($b) {\n        $this->b = $b;\n    }\n    public function __get($name) {\n        if ($name == 'pattern') {\n            $this->b ='|(?P<name>)(\\d+)|';\n        } elseif ($name =='match') {\n            $this->b = array();\n            $this->b[] = 0xffffffff;\n        }\n        return $this->b;\n    }\n}\n\n$b = new __Get('');\n$pattern = $b->__get('pattern');\npreg_match($pattern, $b->__get('match')[0], $m);\nvar_dump($m);\n?>\n"})

    #func = random.choice(functions)
    #context.append({'role':'user','content':'Consider using PHP_INT_MAX, PHP_INT_MIN, PHP_FLOAT_MAX, PHP_FLOAT_MIN. Mix the structures, characteristics, and features of A and B to create something new.\nA:\n```\n{f}\n```\nB:\n```\n{m}\n```'.format(f=female,m=male)})
    #context.append({'role':'user','content':'Consider using PHP_INT_MAX, PHP_INT_MIN, PHP_FLOAT_MAX, PHP_FLOAT_MIN. Consider adding this function: ' + func + ' Mix the structures of A and B to create something new.\nA:\n```\n{f}\n```\nB:\n```\n{m}\n```'.format(f=female,m=male)})
    context.append({'role':'user','content':'Intermingle structures, characteristics, and aspects from A and B to create something new.\nA:\n```\n{f}\n```\nB:\n```\n{m}\n```'.format(f=female,m=male)})

    return context
#if __name__ == "__main__":
#    main()

def translate(JS, influence):
    context = prefix()
    #context.append({'role':'user','content':'another'})
    #context.append({'role':'assistant','content':influence})
    context.append({'role':'user','content':'Use this JavaScript CVE to make a PHP attack: ```\n{}\n```'.format(JS)})
    return context

def new_seed(influence, functions, new_code=None):
    type_num = random.randint(0,2)
    context = prefix()
    if type_num == 0:
        context.append({'role':'user','content':'another'})
        context.append({'role':'assistant','content':influence})
        context.append({'role':'user','content':'Consider using PHP_INT_MAX, PHP_INT_MIN,     PHP_FLOAT_MAX, PHP_FLOAT_MIN. Make this unexpected, weird, and potentially incorrect:\n```\n{}\n```'.format(new_code)})
    elif type_num == 1:
        context.append({'role':'user','content':'another'})
        context.append({'role':'assistant','content':influence})
        if len(functions) == 0:
            functions = utils.load_pickle('functions.pickle')
        func = functions.pop(random.randint(0,len(functions)-1))
        #func = functions.pop()
        context.append({'role':'user','content':'Consider using PHP_INT_MAX, PHP_INT_MIN, PHP_FLOAT_MAX, PHP_FLOAT_MIN. Use this function {} in code. Make it unexpected, weird, and dangerous'.format(func)})
    elif type_num == 2:
        context.append({'role':'user','content':'another'})
        context.append({'role':'assistant','content':influence})
        context.append({'role':'user','content':'another'})
    return context
