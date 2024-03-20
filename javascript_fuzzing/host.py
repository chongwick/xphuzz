# First, you run this file on the host GPU-enabled machine
# Second, submit an LLM type
# The LLM object will be created, and this script will run in an infinite loop,
# querying the model type. ARGUMENTS FILE must be present BEFORE setting LLM
import os
import sys
import pickle
from inspect import signature
import star_llama

CHAT = "chat"
COMPLETION = "completion"
FIM = "fim"

#class llm():
#    def __init__(self, context):
#        self.hi = 1
#    def change_response_max_length(self,x):
#        print("here")
#        self.hi = 12

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

def main():
    terminate_file = "__terminate__"
    llm_type_file = "__llm_type__"
    #Arguments file shall have the format:
    # {'command': function, 'params':[function parameters]}
    llm_query_file = "__llm_query__"
    arguments_file = "arguments.pickle"
    output_file = "__output__"
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
                if "chat" in llm_type:
                    llm_type = CHAT
                    del(llm_object)
                    arguments = get_arguments(arguments_file)
                    context = arguments['context']
                    llm_object = star_llama.Chat_LLM(context)
                    with open(output_file, "w") as f:
                        f.write("1")
                elif "completion" in llm_type:
                    llm_type = COMPLETION
                    del(llm_object)
                    llm_object = star_llama.Completion_LLM()
                    with open(output_file, "w") as f:
                        f.write("1")
                elif "fim" in llm_type:
                    llm_type = FIM
                    del(llm_object)
                    llm_object = star_llama.FIM_LLM()
                    with open(output_file, "w") as f:
                        f.write("1")
                os.remove(llm_type_file)
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
