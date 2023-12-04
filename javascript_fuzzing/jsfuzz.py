import os
import random
from penguin import Prompter
import parser
from llm import LLM_Instance

INJECT_STATEMENT = 0
INJECT_VARIABLE = 1

class Generator():
    def __init__(self, llm, input_directory, output_file, base_seed=None):
        self.llm = llm
        self.input_directory = input_directory
        self.output_file = output_file
        self.base_seed = base_seed
        self.prompter = Prompter()
        self.seed_files = os.listdir(self.input_directory)
        self.record = {}
        if self.base_seed == None:
            self.base_seed = random.choice(self.seed_files)

    def get_content(self, seed_file): # Read file and parse structures
        file_path = self.input_directory + "/" + seed_file
        with open(file_path, "r") as f:
            seed_content = f.read()
        structures  = parser.parse_structures(file_path)
        output = {'content': seed_content, 'loops': structures[0], 'conditionals': structures[1],
                  'functions': structures[2]}
        return(output)

    def query_llm(self, prompt):
        self.llm.add_context('user', prompt)
        return(self.llm.context[-1]['content'])
        
    def mutate(self, seed_data, seed_name, random_gen=True):
        self.record[seed_name] = []
        operation = None
        statement_number = None
        if random_gen:
            operation = random.randint(0,1)
            statement_number = random.randint(1,5)
            structure_type = random.choice(['loops','conditionals','functions'])
            structure_target = random.choice(seed_data[structure_type]) # line number, content
        if operation == INJECT_STATEMENT:
            prompt, code = self.prompter.inject_statement(
                    seed_data['content'], statement_number, structure_target[0])
        elif operation == INJECT_VARIABLE:
            prompt, code = self.prompter.inject_variable(
                    seed_data['content'], statement_number, structure_target[0])

        self.record[seed_name].append({'operation':operation,'location':structure_target[0],
                                       'structure':structure_type})
        write_output(self.output_file, 
                     code.replace(self.prompter.delimiter,self.query_llm(prompt)))
        self.llm.reset_context()
        return code

    def run(self, cycles):
        # First seed mutation start 
        seed_data = self.get_content(self.base_seed) # Get file contents and parsed structures
        mutated_code = self.mutate(seed_data, self.base_seed)

        # First seed mutation end
        for count in range(cycles):
            #mutate
            continue
        # Extension should be run at the end to ensure the script runs
        # i.e. there may be defined functions but no call to them
        prompt = self.prompter.extend(mutated_code)
        write_output(self.output_file, self.query_llm(prompt))

def write_output(file_name,output):
    with open(file_name, "w") as f:
        f.write(output)

def main():
    context = [{'role': 'system', 'content': "You are a coding tool and \
                reply ONLY with JAVASCRIPT CODE."}]
    llm = LLM_Instance(context, 0.25) # Default temperature is 0.25
    input_directory = "snippet2"
    output_file = "output.js"


    generator = Generator(llm, input_directory, output_file)
    generator.run(1)

    #prompt, code = prompter.inject_statement(snippet, context, 4, 2)
    #add_context(context, 'user', prompt)
    #write_output(output_file, code.replace(prompter.delimiter,context[-1]['content']))
    #reset_context(context)

    #prompt = prompter.extend(snippet, context)
    #llm.add_context('user', prompt)
    #write_output(output_file, context[-1]['content'])

if __name__ == "__main__":
    main()
