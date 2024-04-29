import executor
from receiver import LLAMA3_LLM
from penguin import Prompter
import sys

class Translator():
    def __init__(self, llm):
        self.llm = llm
        self.prompter = Prompter()

    def query_llm(self, prompt):
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
        if code == "":
            print("\n! Re-query: Format Error !\n")
            code = self.query_llm(self.prompter.code_format_fix())
        if "<?php" not in code.split("\n")[0]:
            code = "<?php\n" + code + "\n?>"
        return code

def main():
    input_directory = sys.argv[1]
    context = [{'role': 'system', 'content':'Translate JavaScript to PHP. Return as ```<code>```'}]
    llm = LLAMA3_LLM(context)
    translator = Translator(llm)
    

if __name__ == "__main__":
    main()
