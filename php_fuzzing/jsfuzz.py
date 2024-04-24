'''
√Map the seeds
Fix the seeds
Fuzz using chatter
del(chatter)
run tests
fuzz w/ completion
del(completer)
fuzz w/ FIM
del(FIM)
'''
import sys
import os
import datetime
import random
import mapper
from generator import Generator
from mutator import Mutator
import native_code.executor as executor
from penguin import Prompter
import parser
from star_llama import Chat_LLM, Completion_LLM, FIM_LLM
import config as cfg

def main():
    global exec_engine
    exec_engine = executor.Executor(timeout_per_execution_in_ms=400, enable_coverage=True)  

    corpus_directory = sys.argv[1].split("/")[0]
    output_directory = "mut_corp_" + corpus_directory
    if not os.path.exists(output_directory):
        os.makedirs(output_directory)

    #seed_cov_map = mapper.load_cor_maps(corpus_directory + "_bms")

    context = [{'role': 'system', 'content': "You are a coding tool and \
                reply ONLY with JAVASCRIPT CODE. We are trying to increase code coverage."}]
    chat_llm = star_llama.Chat_LLM(context, 0.25)
    mutator = Mutator(completer, corpus_directory, output_directory)
    mutator.run()
    del(chat_llm)

if __name__ == "__main__":
    main()
