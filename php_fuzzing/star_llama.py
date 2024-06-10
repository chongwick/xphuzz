from transformers import AutoTokenizer, AutoModelForCausalLM, StoppingCriteria
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
LLAMA3 = "llama3"

llm_workdir = "llm_workdir/"
terminate_file = llm_workdir + "__terminate__"
llm_type_file = llm_workdir + "__llm_type__.pickle"
#Arguments file shall have the format:
# {'command': function, 'params':[function parameters]}
#llm_query_file = llm_workdir + "__llm_query__"
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
    if llm_type == LLAMA3:
        llm_functions = LLAMA3_FUNCTIONS
    elif llm_type == COMPLETION:
        llm_functions = COMPLETION_FUNCTIONS
    elif llm_type == FIM:
        llm_functions = FIM_FUNCTIONS
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
        "give_context":
        lambda llm, c: llm.give_context(c),
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
LLAMA3_FUNCTIONS = {
        "change_response_max_length":
        lambda llm, l : llm.change_response_max_length(l),
        "change_temperature":
        lambda llm, t : llm.change_temperature(t),
        "give_context":
        lambda llm, c: llm.give_context(c),
        "add_context":
        lambda llm, r, c: llm.add_context(r,c),
        "reset_context":
        lambda llm : llm.reset_context(),
        "change_role":
        lambda llm, rd : llm.change_role(rd),
}

#NEW
class MyStoppingCriteria(StoppingCriteria):
    def __init__(self, target_sequence, prompt, tokenizer):
        self.target_sequence = target_sequence
        self.prompt=prompt
        self.tokenizer = tokenizer

    def __call__(self, input_ids, scores, **kwargs):
        # Get the generated text as a string
        generated_text = self.tokenizer.decode(input_ids[0])
        generated_text = generated_text.replace(self.prompt,'')
        # Check if the target sequence appears in the generated text
        if self.target_sequence in generated_text:
            return True  # Stop generation

        return False  # Continue generation

    def __len__(self):
        return 1

    def __iter__(self):
        yield self
#NEW

class Chat_LLM:
    def __init__(self, context, temperature=0.1):
        self.context = context
        self.original_context = self.context.copy()
        self.temperature = temperature
        self.max_response_length = 500
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

    def give_context(self, context):
        self.context = context
        inputs = self.tokenizer.apply_chat_template(
                self.context,
                add_generation_prompt=True,
                return_tensors="pt").to(self.model.device)
        output = self.model.generate(inputs,
                                 max_new_tokens=self.max_response_length,
                                 eos_token_id=self.terminators,
                                 do_sample=True,
                                 temperature=self.temperature,
                                 top_p=0.9,)
        result = output[0][inputs.shape[-1]:]
        response = self.tokenizer.decode(result, skip_special_tokens=True)
        return response

    def add_context(self, role, content):
        content_length = num_tokens_from_string(content)
        if content_length > self.absolute_max / 2:
            response = "<?php\necho \"did not work;\"\n?>"
            self.context.append({'role': 'assistant', 'content': response})
            return response
        if content_length > self.max_response_length / 2:
            self.change_response_max_length(content_length*3)
        self.context.append({'role': role, 'content': content})
        self.token_count += self.num_tokens_from_string(content)
        """this doesn't work
        if self.token_count > cfg.token_max:
            while(self.token_count > cfg.token_max):
                #gotta do it twice because it needs to alternate user/system/user/system
                popped = self.context.pop(1)
                self.token_count -= self.num_tokens_from_string(popped['content'])
                popped = self.context.pop(1)
                self.token_count -= self.num_tokens_from_string(popped['content'])
            #self.reset_context()
            #raise RuntimeError("Exceeded Max Tokens ({m}): {t}".format(m=cfg.token_max,
            #                                                           t=self.token_count))
        """
        inputs = self.tokenizer.apply_chat_template(self.context, return_tensors="pt").to("cuda")

        output = self.model.generate(input_ids=inputs, max_new_tokens=self.max_response_length, 
                                     do_sample=True,
                                     temperature=self.temperature, 
                                     pad_token_id=self.tokenizer.eos_token_id,
                                     )
                                     
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
        self.original_context = self.context.copy()
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

class LLAMA3_LLM:
    def __init__(self, context, temperature=0.6):
        self.context = context
        self.model_id = "meta-llama/Meta-Llama-3-8B-Instruct"
        self.original_context = self.context.copy()
        self.temperature = temperature
        self.absolute_max = 1048576
        self.max_response_length = 500
        self.tokenizer = AutoTokenizer.from_pretrained(self.model_id)
        self.terminators = [self.tokenizer.eos_token_id,
                       self.tokenizer.convert_tokens_to_ids("<|eot_id|>")]
        self.token_count = self.num_tokens_from_string(self.context[0]['content'])
        self.model = AutoModelForCausalLM.from_pretrained(
           self.model_id,
           torch_dtype=torch.float16,
           device_map="auto",
        )

    def change_response_max_length(self, length):
        self.max_response_length = length
        return

    def change_temperature(self, temperature):
        self.temperature = temperature
        return

    def give_context(self, context):
        self.context = context
        inputs = self.tokenizer.apply_chat_template(
                self.context,
                add_generation_prompt=True,
                return_tensors="pt").to(self.model.device)
        output = self.model.generate(inputs,
                                 max_new_tokens=self.max_response_length,
                                 eos_token_id=self.terminators,
                                 do_sample=True,
                                 temperature=self.temperature,
                                 top_p=0.9,)
        result = output[0][inputs.shape[-1]:]
        response = self.tokenizer.decode(result, skip_special_tokens=True)
        return response

    def add_context(self, role, content):
        content_length = num_tokens_from_string(content)
        if content_length > self.absolute_max / 2:
            print("diddnasn; work")
            response = "<?php\necho \"did not work;\"\n?>"
            self.context.append({'role': 'assistant', 'content': response})
            return response
        self.context.append({'role': 'assistant', 'content': response})
        if content_length > self.max_response_length / 2:
            self.change_response_max_length(content_length*3)
        self.context.append({'role': role, 'content': content})
        #self.token_count += self.num_tokens_from_string(content)
        #if self.token_count > cfg.token_max:
        #    while(self.token_count > cfg.token_max):
        #        #gotta do it twice because it needs to alternate user/system/user/system
        #        popped = self.context.pop(1)
        #        self.token_count -= self.num_tokens_from_string(popped['content'])
        #        popped = self.context.pop(1)
        #        self.token_count -= self.num_tokens_from_string(popped['content'])
        #    #self.reset_context()
        #    #raise RuntimeError("Exceeded Max Tokens ({m}): {t}".format(m=cfg.token_max,
        #    #                                                           t=self.token_count))
        inputs = self.tokenizer.apply_chat_template(
                self.context,
                add_generation_prompt=True,
                return_tensors="pt").to(self.model.device)
        output = self.model.generate(inputs,
                                 max_new_tokens=self.max_response_length,
                                 eos_token_id=self.terminators,
                                 do_sample=True,
                                 temperature=self.temperature,
                                 top_p=0.9,)
        result = output[0][inputs.shape[-1]:]
        response = self.tokenizer.decode(result, skip_special_tokens=True)
        self.context.append({'role': 'assistant', 'content': response})
        return response

    def reset_context(self):
        self.context = self.original_context.copy()
        self.token_count = self.num_tokens_from_string(self.context[0]['content'])

    def change_role(self, role_description):
        self.context = [{'role': 'system', 'content': role_description}]
        self.original_context = self.context.copy()
        return

    def num_tokens_from_string(self, string, encoding_name="cl100k_base"):
        encoding = tiktoken.get_encoding(encoding_name)
        num_tokens = len(encoding.encode(string))
        return num_tokens

def main():
    print("******* Star Llama Started ********")
    for i in os.listdir(llm_workdir):
        if os.path.isfile(i):
            os.remove(i)

    llm_type = None
    cur_llm_type = None
    llm_object = None

    is_terminate = lambda : (os.path.isfile(terminate_file) and 
            os.path.getsize(terminate_file) > 0)
    set_llm_type = lambda : (os.path.isfile(llm_type_file) and
            os.path.getsize(llm_type_file) > 0)
    is_query = lambda : (os.path.isfile(arguments_file) and
            os.path.getsize(arguments_file) > 0)
    while(True):
        #try:
        #Check for termination/change command files
        if is_terminate():
            os.remove(terminate_file)
            quit()
        elif set_llm_type():
            with open(llm_type_file, "rb") as f:
                pickle_juice = pickle.load(f)
            llm_type = pickle_juice[0]
            context = pickle_juice[1]
            if llm_type != cur_llm_type:
                del(llm_object)
                llm_object = None
                torch.cuda.empty_cache()
                if "chat" in llm_type:
                    llm_type = CHAT
                    cur_llm_type = CHAT
                    llm_object = Chat_LLM(context)
                elif "llama3" in llm_type:
                    llm_type = LLAMA3
                    cur_llm_type = LLAMA3
                    llm_object = LLAMA3_LLM(context)
                elif "completion" in llm_type:
                    llm_type = COMPLETION
                    cur_llm_type = COMPLETION
                    llm_object = Completion_LLM()
                elif "fim" in llm_type:
                    llm_type = FIM
                    cur_llm_type = FIM
                    llm_object = FIM_LLM()
            with open(output_file, "w") as f:
                f.write("1")
            os.remove(llm_type_file)
        elif is_query():
            arguments = get_arguments(arguments_file)
            #os.remove(llm_query_file)
            os.remove(arguments_file)
            try:
                result = execute_function(llm_type, llm_object, arguments)
            except Exception as e:
                print("didnot work")
                result = "<?php\necho \"did not work;\"\n?>"
            with open(output_file, "w") as f:
                if result != None:
                    f.write(result)
                else:
                    f.write("1")
        else:
            pass

        #except Exception as e:
        #    print("EXCEPTION: ",e)
        #    for i in os.listdir(llm_workdir):
        #        if os.path.isfile(i):
        #            os.remove(i)
        #    with open(output_file, "w") as f:
        #        f.write("error")
        #    torch.cuda.empty_cache()

if __name__ == "__main__":
    main()
