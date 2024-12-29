import utils
import pickle
import os
import config as cfg
import time

llm_workdir = "llm_workdir/"
llm_workdir = "/home/w023dtc/llm/llm_workdir/"
#output_file = llm_workdir + "__output__"
output_file = "/home/w023dtc/llm/llm_workdir/__output__"
is_output = lambda : (os.path.isfile(output_file) and 
        os.path.getsize(output_file) > 0)
#terminate_file = llm_workdir + "__terminate__"
terminate_file = "/home/w023dtc/llm/llm_workdir/__terminate__"
#llm_type_file = llm_workdir + "__llm_type__.pickle"
llm_type_file = "/home/w023dtc/llm/llm_workdir/__llm_type__.pickle"
#llm_query_file = llm_workdir + "__llm_query__"
#arguments_file = llm_workdir + "arguments.pickle"
arguments_file = "/home/w023dtc/llm/llm_workdir/arguments.pickle"


def send_command_file(file, content=""):
    #print(file, content)
    try:
        with open(file, "w") as f:
            f.write(content)
    except Exception as e:
        time.sleep(1)
        with open(file, "w") as f:
            f.write(content)

def submit(arguments):
    with open(arguments_file, "wb") as f:
        pickle.dump(arguments,f)
    #send_command_file(llm_query_file)
    while(not(is_output())):
        pass
    with open(output_file, "r") as f:
        result = f.read()
    os.remove(output_file)
    return result

class Chat_LLM:
    def __init__(self, context, temperature=0.1):
        self.context = context
        self.original_context = self.context.copy()
        type_info = ("chat", context)
        with open(llm_type_file, "wb") as f:
            pickle.dump(type_info,f)
        while(not(is_output())):
            pass
        os.remove(output_file)
        
    def change_response_max_length(self, length):
        arguments = {
                'command':"change_response_max_length",'params':[length]
                }
        return submit(arguments)

    def change_temperature(self, temperature):
        arguments = {
                'command':"change_temperature",'params':[temperature]
                }
        return submit(arguments)

    def give_context(self, context):
        arguments = {
                'command':"give_context",'params':[context]
                }
        result = submit(arguments)
        return result

    def add_context(self, role, content):
        arguments = {
                'command':"add_context",'params':[role, content]
                }
        result = submit(arguments)
        #idk maybe return this who knows
        self.context.append({'role': 'assistant', 'content': result})
        return self.context
        #return result

    def reset_context(self):
        self.context = self.original_context
        arguments = {
                'command':"reset_context",'params':[]
                }
        return submit(arguments)

    def change_role(self, role_description):
        self.context = [{'role': 'system', 'content': role_description}]
        self.original_context = self.context.copy()
        arguments = {
                'command':'change_role','params':[role_description]
                }
        return submit(arguments)

class Completion_LLM:
    def __init__(self, temperature=0.1):
        type_info = ("completion", None)
        with open(llm_type_file, "wb") as f:
            pickle.dump(type_info,f)
        while(not(is_output())):
            pass
        os.remove(output_file)

    def change_temperature(self, temperature):
        arguments = {
                'command':"change_temperature",'params':[temperature]
                }
        return submit(arguments)

    def change_response_max_length(self, length):
        arguments = {
                'command':"change_response_max_length",'params':[length]
                }
        return submit(arguments)

    def get_completion(self, content):
        arguments = {
                'command':"get_completion",'params':[content]
                }
        return submit(arguments)

class FIM_LLM:
    def __init__(self, temperature=0.1):
        type_info = ("fim", None)
        with open(llm_type_file, "wb") as f:
            pickle.dump(type_info,f)
        while(not(is_output())):
            pass
        os.remove(output_file)

    def change_temperature(self, temperature):
        arguments = {
                'command':"change_temperature",'params':[temperature]
                }
        return submit(arguments)

    def change_response_max_length(self, length):
        arguments = {
                'command':"change_response_max_length",'params':[length]
                }
        return submit(arguments)

    def fill_in_middle(self, content):
        arguments = {
                'command':"fill_in_middle",'params':[content]
                }
        return submit(arguments)

class LLAMA3_LLM:
    def __init__(self, context, temperature=0.6):
        self.context = context
        self.original_context = self.context.copy()
        type_info = ("llama3", context)
        with open(llm_type_file, "wb") as f:
            pickle.dump(type_info,f)
        while(not(is_output())):
            pass
        os.remove(output_file)
        
    def change_response_max_length(self, length):
        arguments = {
                'command':"change_response_max_length",'params':[length]
                }
        return submit(arguments)

    def change_temperature(self, temperature):
        arguments = {
                'command':"change_temperature",'params':[temperature]
                }
        return submit(arguments)

    def give_context(self, context):
        arguments = {
                'command':"give_context",'params':[context]
                }
        result = submit(arguments)
        #start_time = int(utils.read_file(cfg.time_file))
        #hour = int((time.time() - start_time) // 1800)
        #hour_prompts = utils.load_pickle(cfg.hour_prompts)
        #if hour not in hour_prompts:
        #    hour_prompts[hour] = 1
        #else:
        #    hour_prompts[hour] += 1
        #utils.dump_pickle(cfg.hour_prompts,hour_prompts)
        return result

    def add_context(self, role, content):
        self.context.append({'role': role, 'content': content})
        arguments = {
                'command':"add_context",'params':[role, content]
                }
        result = submit(arguments)
        #idk maybe return this who knows
        self.context.append({'role': 'assistant', 'content': result})
        return self.context
        #return result

    def reset_context(self):
        self.context = self.original_context
        arguments = {
                'command':"reset_context",'params':[]
                }
        return submit(arguments)

    def change_role(self, role_description):
        self.context = [{'role': 'system', 'content': role_description}]
        self.original_context = self.context.copy()
        arguments = {
                'command':'change_role','params':[role_description]
                }
        return submit(arguments)
