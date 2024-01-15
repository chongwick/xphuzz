import sys
import os
import datetime
import random
current_dir = os.path.dirname(os.path.realpath(__file__))
base_dir = os.path.abspath(os.path.join(current_dir, '..'))
if base_dir not in sys.path: sys.path.append(base_dir)
import mapper
from corpus_generator import Generator
import coverage.native_code.executor as executor
from penguin import Prompter
import parser
from llm import LLM_Instance

def perror(msg):
    print("[-] ERROR: %s" % msg)
    raise Exception()

def main():
    global exec_engine
    exec_engine = executor.Executor(timeout_per_execution_in_ms=400, enable_coverage=True)

    corpus_directory = sys.argv[1].split("/")[0]
    output_file =  "../" + corpus_directory + "/output.js"

    #mapper.map_seed_bitmap(corpus_directory, exec_engine, "base_map_v8_1_12_24")
    g = mapper.load_map("test_dir_bms")
    
    context = [{'role': 'system', 'content': "You are a coding tool and \
                reply ONLY with JAVASCRIPT CODE."}]
    llm = LLM_Instance(context, 0.25) # Default temperature is 0.25

    generator = Generator(llm, corpus_directory, output_file)
    generator.run(1)

if __name__ == "__main__":
    main()
