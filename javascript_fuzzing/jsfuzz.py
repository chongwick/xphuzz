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
import native_code.executor as executor
from penguin import Prompter
import parser
import renamer
from llm import LLM_Instance
import config as cfg

def parse_args(args):
    help_command = False
    if "-h" in args:
        help_command = True
        if args[0] == "-h":
            print("options: [bmg[s][ns] (dir)] [f (dir)]")
            quit()
    if "-bmg" in args[0]:
        if help_command:
            print("Bitmap Generation: Include Corpus Directory. Sort out zero coverage increases")
            quit()
        if "ns" in args[0]:
            return "bmgns"
        elif "s" in args[0]:
            return "bmgs"
    elif args[0] == "-fz":
        if help_command:
            print("Fuzzing: Include Corpus Directory")
            quit()
        return "fz"
    elif args[0] == "-fx":
        if help_command:
            print("Fixing: Include Corpus Directory")
            quit()
        return "fx"
    elif args[0] == "-sz":
        if help_command:
            print("Identifying uncommon lines in corpus")
            quit()
        return "sz"
    else:
        print("!!! Invalid Option: {} !!!".format(args[0]))
        quit()

def perror(msg):
    print("[-] ERROR: %s" % msg)
    raise Exception()

def main():
    global exec_engine
    action = parse_args(sys.argv[1:])
    exec_engine = executor.Executor(timeout_per_execution_in_ms=400, enable_coverage=True)

    corpus_directory = None

    if action == "bmgs" or action == "bmgns":
        corpus_directory = sys.argv[2].split("/")[0]
        output_file = corpus_directory + "/output.js"
        seed_cov_map = mapper.map_seed_bitmap(corpus_directory, exec_engine, "base_map_v8_1_12_24")
        if action == "bmgs":
            no_new_edge_dir = corpus_directory+"_C0V"
            os.mkdir(no_new_edge_dir)
            for i in seed_cov_map:
                if "0bm" in seed_cov_map[i]:
                    os.rename(corpus_directory+"/"+i,no_new_edge_dir+"/"+i)
                    os.rename(seed_cov_map[i], no_new_edge_dir+"/"+seed_cov_map[i].split("/")[1])
        return







    elif action == "fz":
        corpus_directory = sys.argv[2].split("/")[0]
        output_directory = "mut_corp_" + corpus_directory
        if not os.path.exists(output_directory):
            os.makedirs(output_directory)
        else:
            print("output directory already exists... do something about it...")
            return
        seed_cov_map = mapper.load_cor_maps(corpus_directory + "_bms")
        context = [{'role': 'system', 'content': "You are a coding tool and \
                    reply ONLY with JAVASCRIPT CODE. We are trying to increase code coverage."}]
        llm = LLM_Instance(context, 0.25) # Default temperature is 0.25
        generator = Generator(llm, exec_engine, seed_cov_map, corpus_directory, output_directory)
        generator.run(1)
        





    elif action == "fx":
        corpus_directory = sys.argv[2].split("/")[0]
        seed_cov_map = {} #Unneeded for fixing in this current scheme
        output_file = "" #Also unnecessary
        context = [{'role': 'system', 'content': "You are a coding tool and \
                    reply ONLY with JAVASCRIPT CODE. We are trying to fix code. \
                    DO NOT REMOVE CODE."}]
        llm = LLM_Instance(context, 0.25) # Default temperature is 0.25
        generator = Generator(llm, exec_engine, seed_cov_map, 
                              corpus_directory, output_file, fix=True)
        broken_seeds = os.listdir(corpus_directory + "_C0V") # Broken is a misnomer as is 0-cov
        for seed in broken_seeds:
            output_file = corpus_directory + "/" + seed.split(".js")[0] + "_FXD.js"
            generator.fix_seed(corpus_directory + "_C0V/" + seed, output_file)
    elif action == "sz":
        corpus_directory = sys.argv[2].split("/")[0]
        output_file = corpus_directory + "/output.js"
        seed_cov_map = mapper.load_cor_maps(corpus_directory + "_bms")
        context = [{'role': 'system', 'content': "You are a coding tool and \
                    reply ONLY with JAVASCRIPT CODE. We are trying to increase code coverage."}]
        llm = LLM_Instance(context, 0.25) # Default temperature is 0.25
        generator = Generator(llm, exec_engine, seed_cov_map, corpus_directory, output_file)
        files = os.listdir(corpus_directory)
        cost = 0
        for file in files:
            cost += generator.summarize(file)
        print("***************final cost***************\n{}".format(cost))
    else: # Run fuzzing without mutations
        corpus_directory = sys.argv[2].split("/")[0]
        exec_engine.load_global_coverage_map_from_file("base_map_v8_1_12_24")
        for i in os.listdir(corpus_directory):
            with open(corpus_directory+"/"+i, "r") as f:
                seed_content = f.read()
                result = exec_engine.execute_safe(seed_content)
                print(result.num_new_edges)
        exec_engine.print_statistics()
        quit()

    #exec_engine.load_global_coverage_map_from_file(seed_cov_map[generator.base_seed])

    #with open(output_file, "r") as f:
    #    mutated_seed = f.read()
    #result = exec_engine.execute_safe(mutated_seed)
    ##print("New Edges After Mutation: {}\n".format(result.num_new_edges))
    ##exec_engine.print_statistics()
    #if result.num_new_edges > 0:
    #    print("Success: {} new edges".format(result.num_new_edges))
    #    print(generator.base_seed, generator.ancilla_seed)
    #else:
    #    print("Failure: no new edges")
    #    print(generator.base_seed, generator.ancilla_seed)

if __name__ == "__main__":
    main()
