from transformers import AutoTokenizer, AutoModelForCausalLM
import transformers
import torch
import os
import tiktoken
import config as cfg
import sys
import pickle

FIM_PREFIX = "<fim_prefix>"
FIM_MIDDLE = "<fim_middle>"
FIM_SUFFIX = "<fim_suffix>"
EOF = "<file_sep>"
FIM_INDICATOR = "<FILL_HERE>"

CHAT = "chat"
COMPLETION = "completion"
FIM = "fim"

llm_workdir = "llm_workdir/"
terminate_file = llm_workdir + "__terminate__"
llm_type_file = llm_workdir + "__llm_type__"
#Arguments file shall have the format:
# {'command': function, 'params':[function parameters]}
llm_query_file = llm_workdir + "__llm_query__"
arguments_file = llm_workdir + "arguments.pickle"
output_file = llm_workdir + "__output__"

#class llm():
#    def __init__(self, context):
#        self.hi = 1
#    def change_response_max_length(self,x):
#        print("here")
#        self.hi = 12

def get_arguments(arguments_file):
    with open(arguments_file, "rb") as f:
        arguments = pickle.load(f)
    return arguments

def execute_function(llm_type, llm_object, arguments):
    llm_functions = None
    if llm_type == CHAT:
        llm_functions = CHAT_FUNCTIONS
    elif llm_type == COMPLETION:
        llm_functions = COMPLETION_FUNCTIONS
    elif llm_type == FIM_FUNCTIONS:
        llm_functions = FIM_FUNTIONS
    function = llm_functions[arguments['command']]
    params = [llm_object] + arguments['params'] #Prepend self to the arguments
    return(function(*params))

def num_tokens_from_string(string, encoding_name="cl100k_base"):
    encoding = tiktoken.get_encoding(encoding_name)
    num_tokens = len(encoding.encode(string))
    return num_tokens

CHAT_FUNCTIONS = {
        "change_response_max_length":
        lambda llm, l : llm.change_response_max_length(l),
        "change_temperature":
        lambda llm, t : llm.change_temperature(t),
        "add_context":
        lambda llm, r, c: llm.add_context(r,c),
        "reset_context":
        lambda llm : llm.reset_context(),
        "change_role":
        lambda llm, rd : llm.change_role(rd),
}
COMPLETION_FUNCTIONS = {
        "change_response_max_length":
        lambda llm, l : llm.change_response_max_length(l),
        "change_temperature":
        lambda llm, t : llm.change_temperature(t),
        "get_completion":
        lambda llm, c : llm.get_completion(c),
}
FIM_FUNCTIONS = {
        "change_response_max_length":
        lambda llm, l : llm.change_response_max_length(l),
        "change_temperature":
        lambda llm, t : llm.change_temperature(t),
        "fill_in_middle":
        lambda llm, c : llm.fill_in_middle(c),
}

class Chat_LLM:
    def __init__(self, context, temperature=0.1):
        self.context = context
        self.original_context = self.context.copy()
        self.temperature = temperature
        self.max_response_length = 250
        self.token_count = self.num_tokens_from_string(self.context[0]['content'])
        self.tokenizer = AutoTokenizer.from_pretrained(cfg.model_id)
        self.model = AutoModelForCausalLM.from_pretrained(
           cfg.model_id,
           torch_dtype=torch.float16,
           device_map="auto",
        )

    def change_response_max_length(self, length):
        self.max_response_length = length
        return

    def change_temperature(self, temperature):
        self.temperature = temperature
        return

    def add_context(self, role, content):
        self.context.append({'role': role, 'content': content})
        self.token_count += self.num_tokens_from_string(content)
        if self.token_count > cfg.token_max:
            while(self.token_count > cfg.token_max):
                popped = self.context.pop(0)
                self.token_count -= self.num_tokens_from_string(popped)
            #self.reset_context()
            #raise RuntimeError("Exceeded Max Tokens ({m}): {t}".format(m=cfg.token_max,
            #                                                           t=self.token_count))
        inputs = self.tokenizer.apply_chat_template(self.context, return_tensors="pt").to("cuda")

        output = self.model.generate(input_ids=inputs, max_new_tokens=self.max_response_length, 
                                     do_sample=True,
                                     temperature=self.temperature, 
                                     pad_token_id=self.tokenizer.eos_token_id)
        output = output[0].to("cpu")
        decoded = self.tokenizer.decode(output)
        response = decoded.split("[/INST]")[-1].split("</s>")[0].lstrip()
        self.context.append({'role': 'assistant', 'content': response})
        return response
        #print(response)

    def reset_context(self):
        self.context = self.original_context.copy()
        self.token_count = self.num_tokens_from_string(self.context[0]['content'])

    def change_role(self, role_description):
        self.context = [{'role': 'system', 'content': role_description}]
        return

    def num_tokens_from_string(self, string, encoding_name="cl100k_base"):
        encoding = tiktoken.get_encoding(encoding_name)
        num_tokens = len(encoding.encode(string))
        return num_tokens

class Completion_LLM:
    def __init__(self, temperature=0.1):
        self.temperature = temperature
        self.max_response_length = 25
        self.tokenizer = AutoTokenizer.from_pretrained(cfg.model_id)
        self.pipeline = transformers.pipeline(
            "text-generation",
            model=cfg.model_id,
            torch_dtype=torch.float16,
            device_map="auto",
        )

    def change_temperature(self, temperature):
        self.temperature = temperature
        return

    def change_response_max_length(self, length):
        self.max_response_length = length
        return

    def get_completion(self, content):
        sequences = self.pipeline(
            content,
            do_sample=True,
            top_k=10,
            temperature=self.temperature,
            top_p=0.95,
            num_return_sequences=1,
            eos_token_id=self.tokenizer.eos_token_id,
            max_new_tokens=self.max_response_length,
        )
        ret_str = ""
        for seq in sequences:
            ret_str += f"{seq['generated_text']}"
        #print(ret_str)
        return ret_str

#https://huggingface.co/spaces/bigcode/bigcode-playground/blob/main/app.py
class FIM_LLM:
    def __init__(self, temperature=0.1):
        self.temperature = temperature
        self.model_id = "bigcode/starcoder2-15b"
        self.device = "cuda"
        self.tokenizer = AutoTokenizer.from_pretrained(self.model_id, truncation_side="left")
        self.model = AutoModelForCausalLM.from_pretrained(self.model_id).to(self.device)
        self.max_response_length = 25

    def change_temperature(self, temperature):
        self.temperature = temperature
        return

    def change_response_max_length(self, length):
        self.max_response_length = length
        return

    def fill_in_middle(self, content):
        if FIM_INDICATOR in content:
            try:
                prefix, suffix = content.split(FIM_INDICATOR)
            except:
                raise ValueError(f"Only one {FIM_INDICATOR} allowed in prompt!")
            content = f"{FIM_PREFIX}{prefix}{FIM_SUFFIX}{suffix}{FIM_MIDDLE}"

        inputs = self.tokenizer(content, return_tensors="pt").to(self.device)
        outputs = self.model.generate(**inputs, max_new_tokens=self.max_response_length)
        generation = [self.tokenizer.decode(
            tensor, skip_special_tokens=False) for tensor in outputs]
        fim_content = generation[0].split(FIM_MIDDLE)[1].split(EOF)[0]
        content.replace(FIM_INDICATOR, fim_content)
        return content

def main():
    llm_type = None
    llm_object = None

    is_terminate = lambda : os.path.isfile(terminate_file)
    set_llm_type = lambda : os.path.isfile(llm_type_file)
    is_query = lambda : os.path.isfile(llm_query_file)

    while(True):

        #Check for termination/change command files
        if is_terminate():
            os.remove(terminate_file)
            quit()
        elif set_llm_type():
            with open(llm_type_file, "r") as f:
                llm_type = f.read()
                del(llm_object)
                torch.cuda.empty_cache()
                if "chat" in llm_type:
                    llm_type = CHAT
                    arguments = get_arguments(arguments_file)
                    context = arguments['context']
                    llm_object = Chat_LLM(context)
                elif "completion" in llm_type:
                    llm_type = COMPLETION
                    llm_object = Completion_LLM()
                elif "fim" in llm_type:
                    llm_type = FIM
                    llm_object = FIM_LLM()
                with open(output_file, "w") as f:
                    f.write("1")
                os.remove(llm_type_file)
                if os.path.isfile(arguments_file):
                    os.remove(arguments_file)
        elif is_query():
            arguments = get_arguments(arguments_file)
            os.remove(llm_query_file)
            os.remove(arguments_file)
            result = execute_function(llm_type, llm_object, arguments)
            with open(output_file, "w") as f:
                if result != None:
                    f.write(result)
                else:
                    f.write("1")
        else:
            pass

if __name__ == "__main__":
    main()
