import pickle
import os

output_file = "__output__"
is_output = lambda : os.path.isfile(output_file)
terminate_file = "__terminate__"
llm_type_file = "__llm_type__"
llm_query_file = "__llm_query__"

def send_command_file(file, content=""):
    with open(file, "w") as f:
        f.write(content)

def submit(arguments):
    with open("arguments.pickle", "wb") as f:
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
        arguments = {"context" : context}
        with open("arguments.pickle", "wb") as f:
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
        return submit(arguments)

    def reset_context(self):
        arguments = {
                'command':"reset_context",'params':[]
                }
        return submit(arguments)

