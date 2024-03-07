import parser
import os
import random
import itertools
from penguin import Prompter
import error_parser
import time
import config as cfg
import pickle
from ast import literal_eval

RANDOM_SEED = 80085
INJECT_STATEMENT = 0
INJECT_VARIABLE = 1
REPLACE_STATEMENT = 2

# Bare bones mutator
class Mutator():
    def __init__(self, llm, input_directory, output_directory):
        self.llm = llm
        self.input_directory = input_directory
        self.output_directory = output_directory
        self.prompter = Prompter()
        self.seed_files = os.listdir(self.input_directory)
        self.base_seed = None
        self.ancilla_seed = None
        with open(cfg.uncommon_line_file, 'rb') as f:
            self.uncommon_lines = pickle.load(f)
        # There are a lot of combinations for mutations. In case the mutations get interrupted,
        # We want a list that tracks what combinations have been completed already.
        self.combo_tracking_list = self.output_directory + "_ctl.pickle"
        if os.path.isfile(self.combo_tracking_list):
            with open(self.combo_tracking_list, 'rb') as f:
                self.seed_combos = pickle.load(f)
        else:
            tmp_combos = list(itertools.combinations(self.seed_files,2))
            self.seed_combos = []
            # Fixed seeds cannot be used as base seeds
            for seed in tmp_combos:
                if "FXD" not in seed[0]:
                    self.seed_combos.append(seed)
            with open(self.combo_tracking_list, "wb") as f:
                pickle.dump(self.seed_combos, f, protocol=pickle.HIGHEST_PROTOCOL)
        #if self.base_seed == None:
        #    self.base_seed = random.choice(self.seed_files)
        #self.exec_engine.load_global_coverage_map_from_file(self.seed_cov_map[self.base_seed])

    # This function selects a new base_seed/ancilla for mutation while updating the tracking file
    def get_seeds(self):
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

    def query_llm_list(self, prompt): # Query LLM For list in correct format
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
        bad_query = (code == "")
        summary = None
        if not(bad_query):
            try:
                summary = literal_eval(code)
            except Exception as e:
                bad_query = True
        if bad_query:
            return None
            print("\n! Re-query: Format Error !\n")
            code = self.query_llm_list(
                    "The response did not correspond to the ```<list>``` format. Only include \
                            the list []. Do not include list_name = ...")
        return summary

    def query_llm_generic(self, prompt):
        try:
            self.llm.add_context('user', prompt)
        except RuntimeError as e:
            return False
        result = self.llm.context[-1]['content']
        return result

    def summarize(self, file):
        self.llm.change_role("You are a JavaScript analyzing assistant")
        #self.uncommon_lines = []
        #with open(cfg.uncommon_line_file, "wb") as f:
        #    pickle.dump(self.uncommon_lines, f, protocol=pickle.HIGHEST_PROTOCOL)
        #quit()
        file_path = self.input_directory + "/" + file
        with open(file_path, "r") as f:
            seed_content = f.read()
        prompt = self.prompter.summarize(code)
        summary = self.query_llm_list(prompt)
        if summary != None:
            self.uncommon_lines.extend(i for i in summary if i not in self.uncommon_lines)
            #print(self.uncommon_lines)
            with open(cfg.uncommon_line_file, "wb") as f:
                pickle.dump(self.uncommon_lines, f, protocol=pickle.HIGHEST_PROTOCOL)
        self.llm.reset_context()

    def insert_mutation(self, code, insertion):
        code = [i+"\n" for i in code.split("\n")]
        for i in range(len(code)):
            if code[i].startswith(self.prompter.delimiter):
                code[i] = insertion + "\n"
                break;
        code = "".join(code)
        return code

    def run(self, cycles):
        # interestinggggg
        #base_seed_data = self.get_content(self.base_seed) # Get file contents and parsed structures
        #line = [random.choice(self.uncommon_lines)]
        #self.llm.change_temperature(1)
        #thang = self.query_llm_code(self.prompter.insert_line(base_seed_data['content'], line))

        #self.print_results(result)
        #print(base_seed_data['content'])
        #print(line)
        #print(thang)
        #return

        #self.get_seeds()
        #base_seed_data = self.get_content(self.base_seed)
        #self.query_llm_list(self.prompter.new_sum(base_seed_data['content']))
        #quit()
        # This loop makes every possible combination of seeds
        while(len(self.seed_combos) != 0):
            self.get_seeds()
            base_seed_data = self.get_content(self.base_seed)
            ancilla_seed_data = self.get_content(self.ancilla_seed)
            interlinked = self.query_llm_code(
                self.prompter.mix(base_seed_data['content'], ancilla_seed_data['content']))
            #interlinked = self.query_llm_code("This did not increase coverage. Try again.")
            file_name = (self.output_directory + "/" +  self.base_seed.split(".")[0] + "__" +
                         self.ancilla_seed.split(".")[0] + ".js")
            write_output(file_name, interlinked)
        os.remove(self.combo_tracking_list)
        return

def write_output(file_name,output):
    with open(file_name, "w") as f:
        f.write(output)

def clear_file(file_name):
    with open(file_name, "w") as f:
        pass

