import sys
import parser
import os
import random
import itertools
from penguin import Prompter
import time
import config as cfg
import pickle
from ast import literal_eval
from receiver import Chat_LLM
import native_code.executor as executor

class Fixer():
    def __init__(self, llm, exec_engine, seed_cov_map,
                 input_directory, output_directory):
        self.llm = llm
        self.exec_engine = exec_engine
        self.seed_cov_map = seed_cov_map
        self.input_directory = input_directory
        self.output_directory = output_directory
        self.output_file = output_directory + "/idk"
        self.prompter = Prompter()
        self.seed_files = os.listdir(self.input_directory)
        self.record = {}
        self.base_seed = None
        self.ancilla_seed = None

    # This function selects a new base_seed/ancilla for mutation while updating the tracking file
    def get_new_seeds(self):
        self.base_seed, self.ancilla_seed = self.seed_combos.pop()
        with open(self.combo_tracking_list, "wb") as f:
            pickle.dump(self.seed_combos, f, protocol=pickle.HIGHEST_PROTOCOL)

    def get_content(self, seed_file): # Read file and parse structures
        file_path = self.input_directory + "/" + seed_file
        with open(file_path, "r") as f:
            seed_content = f.read()
        structures  = parser.parse_structures(file_path)
        output = {'content':seed_content, 'loops':structures[0], 'conditionals':structures[1],
                  'functions':structures[2], 'structure_ends':structures[3]}
        return(output)

    def query_llm_code(self, prompt): # Query LLM For code in correct format
        #time.sleep(20) # 3 prompts per minute
        print("\n-- Querying LLM --\n")
        try:
            self.llm.add_context('user', prompt)
        except RuntimeError as e: #Runtime error will be raised if the context window is exceeded
            return False
        result = self.llm.context[-1]['content']
        result = [line + "\n" for line in result.split("\n")]
        code_section = False
        code = ""
        for line in result:
            if "```" in line and not(code_section):
                code_section = True
            elif "```" in line and code_section:
                break
            elif code_section:
                code += line
        #TODO: Handle this more gracefully 
        #TODO: you a bitch up there
        if code == "":
            print("\n! Re-query: Format Error !\n")
            code = self.query_llm_code(self.prompter.code_format_fix())
        return code


    # This doesn't need to be deleted as it is entirely separate from the mutation code
    # Move it though
    def fix_seed(self, file, output_file):
        print("\n-- Fixing {} --\n".format(file))
        with open(file, "r") as f:
            seed_content = f.read()
        error_parser.clear_error_file()
        result = self.exec_engine.execute_safe(seed_content)
        error_message = error_parser.parse_error()
        #self.exec_engine.execute_debug(file)
        #error_message = error_parser.parse_error(cfg.error_file)
        if not(error_message): # Some code does not contain syntax errors
            write_output(output_file, seed_content)
            print("Fix: SUCCESS")
            return
        else:
            prompt = "JavaScript Code:\n```" + seed_content + "\n```"
            prompt += ("This is its error: " + error_message +
                       "Fix this." +
                       "\nDo not remove code. Only respond with ```<code>```")
            code = self.query_llm_code(prompt)
            result, code = self.execute_code(code, fix=True, fix_attempts=2)
            if result == False:
                print("FIX:FAILED {f} -> {e}".format(
                    f=file, e=error_parser.parse_error()))
            else:
                write_output(output_file, code) 
                print("Fix: SUCCESS")
            self.llm.reset_context() #Don't want this getting too big
            return
        
    # Load a coverage map before executing
    def execute_code(self, code, fix=False, fix_attempts=1):
        is_error = lambda x: len(x) != 0
        print("\n -- Executing Code -- \n")
        error_parser.clear_error_file()
        result = self.exec_engine.execute_safe(code)
        error_message = error_parser.parse_error()

        while(is_error(error_message) and fix_attempts != 0):
            fix_attempts -= 1
            print("\n! JavaScript Error: Re-querying LLM !\n")
            error_parser.clear_error_file()
            code = self.query_llm_code("Fix this and return in the proper format\n" + error_message)
            if code == False:
                return False, None
            self.exec_engine.load_global_coverage_map_from_file(cfg.base_map)
            result = self.exec_engine.execute_safe(code)
            error_message = error_parser.parse_error()

        if is_error(error_message):
            print("\n!! JavaScript Error: See __err__ !!\n")
            return False, None
        else:
            return result, code

def write_output(file_name,output):
    with open(file_name, "w") as f:
        f.write(output)

def main():
    exec_engine = executor.Executor(timeout_per_execution_in_ms=400, enable_coverage=True)
    corpus_directory = sys.argv[1].split("/")[0]
    seed_cov_map = {} #Unneeded for fixing in this current scheme
    output_file = "" #Also unnecessary
    system_role = "You are a code fixing tool and reply only with JavaSript Code. \
            Your replies should be formatted as ```<code>```"
    context = [{'role': 'system', 'content': system_role}]
    #context = [{'role': 'system', 'content': 'You are a code fixing tool and reply only with JavaSript Code. Your replies should be formatted as ```<code>```'}, {'role': 'user', 'content': 'Here is JavaScript Code: ```console.log(hi);``` This is its error: ReferenceError: hi is not defined. Fix this. Do not comment. Do not remove any code. Reply only with code.'}, {'role': 'assistant', 'content': '```\nconst hi = "Hello, World!";\nconsole.log(hi);\n``` The issue was that the `hi` variable was not defined.'}, {'role': 'user', 'content': 'You were supposed to reply only with the code'}, {'role': 'assistant', 'content': '```\nconst hi = "Hello, World!";\nconsole.log(hi);\n```'}]

    context.append({'role': 'user', 'content': "Here is JavaScript Code: ```console.log(hi);``` \
            This is its error: ReferenceError: hi is not defined. Fix this. Do not comment. \
            Do not remove any code. Reply only with code."})
    context.append({'role': 'assistant', 'content': "```\nconst hi = \"Hello, World!\";\n\
            console.log(hi);\n``` The issue was that the `hi` variable was not defined."})
    context.append({'role': 'user', 'content': "You were supposed to reply only with the code"})
    context.append({'role': 'assistant', 'content': "```\nconst hi = \"Hello, World!\";\n\
            console.log(hi);\n```"})

    chatter = Chat_LLM(context, 0.25) # Default temperature is 0.25
    fixer = Fixer(chatter, exec_engine, seed_cov_map,
                          corpus_directory, output_file)
    broken_seeds = os.listdir(corpus_directory + "_C0V") # Broken is a misnomer as is 0-cov
    for seed in broken_seeds:
        output_file = corpus_directory + "/" + seed.split(".js")[0] + "_FXD.js"
        if os.path.isfile(output_file):
            print("Already fixed :)")
            continue
        else:
            fixer.fix_seed(corpus_directory + "_C0V/" + seed, output_file)

if __name__ == "__main__":
    main()
