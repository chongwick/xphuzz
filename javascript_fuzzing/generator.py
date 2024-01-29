import parser
import os
import random
import itertools
from penguin import Prompter
import error_parser
import time

RANDOM_SEED = 80085
INJECT_STATEMENT = 0
INJECT_VARIABLE = 1
REPLACE_STATEMENT = 2

class Generator():
    def __init__(self, llm, exec_engine, seed_cov_map, input_directory, output_file, fix=False):
        self.llm = llm
        self.exec_engine = exec_engine
        self.seed_cov_map = seed_cov_map
        self.input_directory = input_directory
        self.output_file = output_file
        self.prompter = Prompter()
        self.seed_files = os.listdir(self.input_directory)
        self.record = {}
        if not(fix):
            tmp_combos = list(itertools.permutations(self.seed_files,2))
            self.seed_combos = []
            # Fixed seeds cannot be used as base seeds
            for seed in tmp_combos:
                if "FXD" not in seed[0]:
                    self.seed_combos.append(seed)
            #if self.base_seed == None:
            #    self.base_seed = random.choice(self.seed_files)
            self.base_seed, self.ancilla_seed = random.choice(self.seed_combos)
            self.exec_engine.load_global_coverage_map_from_file(self.seed_cov_map[self.base_seed])

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
            code = self.query_llm_code(
                    "The response did not correspond to the ```<code>``` format.")
        return code

    def query_llm_generic(self, prompt):
        try:
            self.llm.add_context('user', prompt)
        except RuntimeError as e:
            return False
        result = self.llm.context[-1]['content']
        return result

    def fix_seed(self, file, output_file):
        print("\n-- Fixing --\n")
        with open(file, "r") as f:
            seed_content = f.read()
        clear_file("__err__")
        result = self.exec_engine.execute_safe(seed_content)
        error_message = error_parser.parse_error("__err__")
        if not(error_message): # Some code does not contain syntax errors
            write_output(output_file, seed_content)
            print("Fix: SUCCESS")
            return
        else:
            prompt = "Here is JavaScript Code:\n```" + seed_content + "\n```"
            prompt += ("This is its error: " + error_message +
                       "Fix this and return in the proper format")
            code = self.query_llm_code(prompt)
            result, code = self.execute_code_new(code, fix=True, fix_attempts=2)
            if result == False:
                print("FIX:FAILED {f} -> {e}".format(
                    f=file, e=error_parser.parse_error("__err__")))
            else:
                write_output(output_file, code) 
                print("Fix: SUCCESS")
            self.llm.reset_context() #Don't want this getting too big
            return
        
    def summarize(self, file):
        self.llm.change_role("You are a JavaScript analyzing assistant")
        file_path = self.input_directory + "/" + file
        with open(file_path, "r") as f:
            seed_content = f.read()
        print('______\n', seed_content, '________\n')
        prompt = seed_content
        prompt += "\nThis is JavaScript Code. Identify special/uncommon numbers/structures in it. Return a Python list of these uncommonalities"
        #prompt += "\nThis is JavaScript Code. Identify special/uncommon lines in it. Return a Python list of these uncommonalities"
        self.query_llm_generic(prompt)
        quit()

    # Load a coverage map before executing
    def execute_code_new(self, code, fix=False, fix_attempts=1):
        is_error = lambda x: len(x) != 0
        print("\n -- Executing Code -- \n")
        clear_file("__err__")
        result = self.exec_engine.execute_safe(code)
        error_message = error_parser.parse_error("__err__")

        while(is_error(error_message) and fix_attempts != 0):
            fix_attempts -= 1
            print("\n! JavaScript Error: Re-querying LLM !\n")
            clear_file("__err__")
            code = self.query_llm_code("Fix this and return in the proper format\n" + error_message)
            if code == False:
                return False, None
            if not fix:
                self.exec_engine.load_global_coverage_map_from_file(self.seed_cov_map[self.base_seed])
            else:
                self.exec_engine.load_global_coverage_map_from_file("base_map_v8_1_12_24")
            result = self.exec_engine.execute_safe(code)
            error_message = error_parser.parse_error("__err__")

        if is_error(error_message):
            print("\n!! JavaScript Error: See __err__ !!\n")
            return False, None
        else:
            if fix:
                return result, code
            else:
                return result

    def print_results(self, result):
        if result.num_new_edges > 0:
            print("Success: {} new edges".format(result.num_new_edges))
            print(self.base_seed, self.ancilla_seed)
        else:
            print("Failure: no new edges")
            print(self.base_seed, self.ancilla_seed)

    def insert_mutation(self, code, insertion):
        code = [i+"\n" for i in code.split("\n")]
        for i in range(len(code)):
            if code[i].startswith(self.prompter.delimiter):
                code[i] = insertion + "\n"
                break;
        code = "".join(code)
        return code

    def mutate(self, seed_data, seed_name, random_gen=True):
        self.record[seed_name] = []
        operation = None
        statement_number = None
        if random_gen:
            operation = random.randint(0,2)
            statement_number = random.randint(1,5)
            structure_type = random.choice(['loops','conditionals','functions','structure_ends'])
            structure_target = random.choice(seed_data[structure_type]) # line number, content
        if operation == INJECT_STATEMENT:
            prompt, code = self.prompter.inject_statement(
                    seed_data['content'], statement_number, structure_target[0], structure_type)
        elif operation == INJECT_VARIABLE:
            prompt, code = self.prompter.inject_variable(
                    seed_data['content'], statement_number, structure_target[0], structure_type)
        elif operation == REPLACE_STATEMENT:
            prompt, code = self.prompter.replace_statement(
                    seed_data['content'], statement_number, structure_target[0], structure_type)

        #Record the mutation
        self.record[seed_name].append({'operation':operation,'location':structure_target[0],
                                       'structure':structure_type})
        new_code = self.insert_mutation(code, self.query_llm_code(prompt))
        self.llm.reset_context()
        return new_code

    def run(self, cycles):
        # First seed mutation involves mixing two seeds together
        self.summarize(self.base_seed)
        return
        base_seed_data = self.get_content(self.base_seed) # Get file contents and parsed structures
        ancilla_seed_data = self.get_content(self.ancilla_seed)
        interlinked = self.query_llm_code(
            self.prompter.mix(base_seed_data['content'], ancilla_seed_data['content']))
        #interlinked = self.query_llm_code("This did not increase coverage. Try again.")
        self.exec_engine.load_global_coverage_map_from_file(self.seed_cov_map[self.base_seed])
        result = self.execute_code_new(interlinked)
        self.print_results(result)
        write_output(self.output_file, interlinked)
        return

        #self.llm.change_temperature(1)
        #new = self.query_llm_code("Insert/Change code to increase coverage.")
        #new = self.query_llm_code("In the mixed coce, wrap a number/variable/string in a function invocation")
        result = self.execute_code(new)
        self.print_results(result)
        return

        #mutated_code = self.mutate(seed_data, self.base_seed)
        #write_to_file = self.output_file
        #write_output(self.output_file, mutated_code)

        # First seed mutation end
        for count in range(cycles-1):
            seed_data = self.get_content(self.output_file)
            mutated_code = self.mutate(seed_data, self.base_seed)
            write_output(self.output_file, mutated_code)
            #mutate

        # Extension should be run at the end to ensure the script runs
        # i.e. there may be defined functions but no call to them
        #prompt = self.prompter.extend(mutated_code)
        #write_output(self.output_file, self.query_llm_code(prompt))

def write_output(file_name,output):
    with open(file_name, "w") as f:
        f.write(output)

def clear_file(file_name):
    with open(file_name, "w") as f:
        pass

