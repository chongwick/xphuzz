from penguin import Prompter
import parser
import os
from llm import LLM_Instance

class Generator():
    def __init__(self, llm, prompter, snippets, output_file):
        self.llm = llm
        self.prompter = prompter
        self.snippets = snippets
        self.output_file = output_file

    def query_llm(self, prompt):
        self.llm.add_context('user', prompt)
        return(self.llm.context[-1]['content'])
        
    def run(self, cycles):
        for count in range(cycles):
            continue
        #Extension should be run at the end to ensure the script runs
        prompt = self.prompter.extend(self.snippets[0])
        self.query_llm(prompt)

def write_output(file_name,output):
    with open(file_name, "w") as f:
        f.write(output)

def main():
    prompter = Prompter()
    context = [{'role': 'system', 'content': "You are a coding tool and \
                reply ONLY with JAVASCRIPT CODE."}]
    llm = LLM_Instance(context, 0.25)

    input_files = ["snippets/snippet.js"]
    output_file = "output.js"
    loops,conditionals = parser.parse_structures(input_files[0])


    with open(input_files[0], "r") as f:
        snippet = f.read()

    generator = Generator(llm, prompter, snippet, output_file)
    #prompt, code = prompter.inject_statement(snippet, context, 4, 2)
    #add_context(context, 'user', prompt)
    #write_output(output_file, code.replace(prompter.delimiter,context[-1]['content']))
    #reset_context(context)
    prompt = prompter.extend(snippet, context)
    llm.add_context('user', prompt)
    write_output(output_file, context[-1]['content'])

if __name__ == "__main__":
    main()
