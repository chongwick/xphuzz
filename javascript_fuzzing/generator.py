import parser
import os
import random
import itertools
from penguin import Prompter

RANDOM_SEED = 80085
INJECT_STATEMENT = 0
INJECT_VARIABLE = 1
REPLACE_STATEMENT = 2

class Generator():
    def __init__(self, llm, input_directory, output_file, base_seed=None):
        self.llm = llm
        self.input_directory = input_directory
        self.output_file = output_file
        self.base_seed = base_seed
        self.prompter = Prompter()
        self.seed_files = os.listdir(self.input_directory)
        self.record = {}
        self.seed_combos = list(itertools.combinations(self.seed_files,2))
        #if self.base_seed == None:
        #    self.base_seed = random.choice(self.seed_files)
        self.base_seed, self.ancilla_seed = random.choice(self.seed_combos)

    def get_content(self, seed_file): # Read file and parse structures
        file_path = self.input_directory + "/" + seed_file
        with open(file_path, "r") as f:
            seed_content = f.read()
        structures  = parser.parse_structures(file_path)
        output = {'content':seed_content, 'loops':structures[0], 'conditionals':structures[1],
                  'functions':structures[2], 'structure_ends':structures[3]}
        return(output)

    def query_llm(self, prompt): # Also format
        self.llm.add_context('user', prompt)
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
        return code
        
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
        new_code = self.insert_mutation(code, self.query_llm(prompt))
        self.llm.reset_context()
        return new_code

    def run(self, cycles):
        # First seed mutation start 
        base_seed_data = self.get_content(self.base_seed) # Get file contents and parsed structures
        ancilla_seed_data = self.get_content(self.ancilla_seed)
        interlinked = self.query_llm(
                self.prompter.mix(base_seed_data['content'], ancilla_seed_data['content']))
        write_output(self.output_file, interlinked)
        return
        mutated_code = self.mutate(seed_data, self.base_seed)
        write_to_file = self.output_file
        write_output(self.output_file, mutated_code)

        # First seed mutation end
        for count in range(cycles-1):
            seed_data = self.get_content(self.output_file)
            mutated_code = self.mutate(seed_data, self.base_seed)
            write_output(self.output_file, mutated_code)
            #mutate

        # Extension should be run at the end to ensure the script runs
        # i.e. there may be defined functions but no call to them
        #prompt = self.prompter.extend(mutated_code)
        #write_output(self.output_file, self.query_llm(prompt))

def write_output(file_name,output):
    with open(file_name, "w") as f:
        f.write(output)
