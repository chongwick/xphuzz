from executor import Executor
from receiver import LLAMA3_LLM
from penguin import Prompter
import config as cfg
import errreader as err
import sys
import os
import pickle

class Fixer():
    def __init__(self, llm):
        self.llm = llm
        self.prompter = Prompter()

    def generate_fix_prompt(self, code, error):
        role = 'Fix PHP code. Return as ```<code>```'
        context = [{'role': 'system', 'content': role}]
        prompt = ""
        prompt += "```\n{c}\n```\n".format(c=code)
        prompt += error
        context.append({'role': 'user', 'content': prompt})
        return context

    def query_fix(self, code, error):
        role = 'Fix PHP code. Return as ```<code>```'
        self.llm.change_role(role)
        prompt = ""
        prompt += "```\n{c}\n```\n".format(c=code)
        prompt += error
        self.llm.add_context('user', prompt)
        result = self.llm.context[-1]['content']
        try:
            return correct_format(self.llm, result, self.prompter)
        except RuntimeError as e:
            return None

class Translator():
    def __init__(self, seed_files, input_directory, output_directory):
        #self.llm = llm
        self.input_directory = input_directory
        self.output_directory = output_directory
        self.prompter = Prompter()
        self.seed_files = seed_files
        #self.seed_files = os.listdir(self.input_directory)

    def pop_seed(self):
        return self.seed_files.pop()

    def generate_translation_prompt(self, content):
        role = 'Translate JavaScript to PHP. Return as ```<code>```'
        context = [{'role': 'system', 'content': role}]
        context.append({'role': 'user', 'content': content})
        return context

    #def query_translate(self, prompt):
    #    print("Translation Query")
    #    role = 'Translate JavaScript to PHP. Return as ```<code>```'
    #    self.llm.change_role(role)
    #    self.llm.add_context('user', prompt)
    #    result = self.llm.context[-1]['content']
    #    try:
    #        return correct_format(self.llm, result, self.prompter)
    #    except RuntimeError as e:
    #        return None

    def get_content(self, seed_file): # Read file and parse structures
        file_path = self.input_directory + "/" + seed_file
        with open(file_path, "r") as f:
            seed_content = f.read()
        return seed_content

def correct_format(llm, result, prompter):
    result = [line + "\n" for line in result.split("\n")]
    if result[0].strip() == "error":
        raise RuntimeError("Restarting LLM") 
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
        llm.add_context('user',(prompter.code_format_fix()))
        code = llm.context[-1]['content']
    try:
        if "<?php" not in code.split("\n")[0]:
            code = "<?php\n" + code + "\n?>"
    except Exception as e:
        print("ERRRORRRRRR")
        print(code)
        quit()
    return code

def main():
    requests = []
    input_directory = sys.argv[1].split("/")[0]
    output_directory = input_directory + "_phps"
    progress_file = input_directory + "_progress.pickle"
    seed_files = os.listdir(input_directory)
    if not os.path.exists(output_directory):
        os.makedirs(output_directory)
    else:
        with open(progress_file, "rb") as f:
            seed_files = pickle.load(f)
    #role = 'You are a chatting assistant'
    #context = [{'role': 'system', 'content': role}]
    #llm = LLAMA3_LLM(context)
    translator = Translator(seed_files, input_directory, output_directory)
    #fixer = Fixer(llm)
    #cov_eng = Executor(cfg.coverage_engine)


    #First, we want to queue up all the translation queries
    while len(translator.seed_files) != 0:
        seed = translator.pop_seed()
        with open(progress_file, "wb") as f:
            pickle.dump(translator.seed_files, f, protocol=pickle.HIGHEST_PROTOCOL)

        query_context = translator.generate_translation_prompt(translator.get_content(seed))
        translation_req_name = os.path.join(cfg.llm_requests,seed.split(".")[0]+"_t")

        cfg.enter_shared_dir(cfg.llm_requests)
        with open(translation_req_name, 'wb') as f:
            pickle_content = (0, query_context) #number of fixes
            pickle.dump(pickle_content, f, protocol=pickle.HIGHEST_PROTOCOL)
        requests.append(translation_req_name)
        with open(cfg.llm_queue, 'wb') as f:
            pickle.dump(requests, f, protocol=pickle.HIGHEST_PROTOCOL)
        cfg.exit_shared_dir(cfg.llm_requests)

        





    # Main Execution Loop: clean bc it's confusing
    '''
    while len(translator.seed_files) != 0:
        seed = translator.pop_seed()

        with open(progress_file, "wb") as f:
            pickle.dump(translator.seed_files, f, protocol=pickle.HIGHEST_PROTOCOL)

        print("SEED: ", seed)
        seed_content = translator.get_content(seed)
        code = translator.query_translate(seed_content)
        if code == None:
            print("code none 1")
            continue
        output_file = os.path.join(output_directory,seed+".php")
        #cfg.write_file(output_file, code)
        with open(output_file, "w") as f:
            f.write(code)
        print("Executing")
        result = cov_eng.execute_prog(output_file)
        if result == -1:
            print("Bad execution")
            continue
        i = 0
        while err.is_error(result):
            i += 1
            code = fixer.query_fix(code, err.parse_error(result, output_file))
            if code == None:
                print("code none 2")
                break;
            #cfg.write_file(output_file, code)
            with open(output_file, "w") as f:
                f.write(code)
            result = cov_eng.execute_prog(output_file)
            if result == -1:
                print("Bad execution 2")
                break;
            if i == 5:
                print("didn't work")
                os.remove(output_file)
                break;

        print("COVERAGE", cov_eng.read(), " Fixes: ", i)
        '''

    #for seed in os.listdir(output_directory):
    #    print(san_eng.execute_prog(os.path.join(output_directory,seed)))
    

if __name__ == "__main__":
    main()
