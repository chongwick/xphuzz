import pickle
import os

llm_workdir = "llm_workdir/"
output_file = llm_workdir + "__output__"
is_output = lambda : os.path.isfile(output_file)
terminate_file = llm_workdir + "__terminate__"
llm_type_file = llm_workdir + "__llm_type__"
llm_query_file = llm_workdir + "__llm_query__"
arguments_file = llm_workdir + "arguments.pickle"

def send_command_file(file, content=""):
    with open(file, "w") as f:
        f.write(content)

def submit(arguments):
    with open(arguments_file, "wb") as f:
        pickle.dump(arguments,f)
    send_command_file(llm_query_file)
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
        arguments = {"context" : context}
        with open(arguments_file, "wb") as f:
            pickle.dump(arguments,f)
        send_command_file(llm_type_file, "chat")
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

class Completion_LLM:
    def __init__(self, temperature=0.1):
        send_command_file(llm_type_file, "completion")
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
        send_command_file(llm_type_file, "fim")
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
