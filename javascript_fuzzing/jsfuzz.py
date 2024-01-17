import sys
import os
import datetime
import random
import argparse
current_dir = os.path.dirname(os.path.realpath(__file__))
base_dir = os.path.abspath(os.path.join(current_dir, '..'))
if base_dir not in sys.path: sys.path.append(base_dir)
import mapper
from generator import Generator
import coverage.native_code.executor as executor
from penguin import Prompter
import parser
from llm import LLM_Instance

def parse_args(args):
    help_command = False
    if "-h" in args:
        help_command = True
        if args[0] == "-h":
            print("options: [bmg (dir)] [f (dir)]")
            quit()
    if args[0] == "-bmg":
        if help_command:
            print("Bitmap Generation: Include Corpus Directory")
            quit()
        return "bmg"
    elif args[0] == "-f":
        if help_command:
            print("Fuzzing: Include Corpus Directory")
            quit()
        return "f"
    else:
        print("---Invalid Option: {}---".format(args[0]))
        quit()

def perror(msg):
    print("[-] ERROR: %s" % msg)
    raise Exception()

def main():
    global exec_engine
    action = parse_args(sys.argv[1:])
    exec_engine = executor.Executor(timeout_per_execution_in_ms=400, enable_coverage=True)

    corpus_directory = None

    if action == "bmg":
        corpus_directory = sys.argv[2].split("/")[0]
        output_file = corpus_directory + "/output.js"
        seed_cov_map = mapper.map_seed_bitmap(corpus_directory, exec_engine, "base_map_v8_1_12_24")
        return
    elif action == "f":
        corpus_directory = sys.argv[2].split("/")[0]
        output_file = corpus_directory + "/output.js"
        seed_cov_map = mapper.load_cor_maps(corpus_directory + "_bms")
    
    context = [{'role': 'system', 'content': "You are a coding tool and \
                reply ONLY with JAVASCRIPT CODE."}]
    llm = LLM_Instance(context, 0.25) # Default temperature is 0.25

    generator = Generator(llm, corpus_directory, output_file)
    generator.run(1)
    print(generator.base_seed)
    exec_engine.load_global_coverage_map_from_file(seed_cov_map[generator.base_seed])
    print("Initial Edge Number: {}\n".format(exec_engine.get_number_triggered_edges()[0]))

    with open(output_file, "r") as f:
        mutated_seed = f.read()
    result = exec_engine.execute_safe(mutated_seed)
    print("New Edges After Mutation: {}\n".format(result.num_new_edges))
    #exec_engine.print_statistics()

if __name__ == "__main__":
    main()
