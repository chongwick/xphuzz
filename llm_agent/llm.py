import openai    
import os
import lib_help

from dotenv import load_dotenv, find_dotenv    
_ = load_dotenv(find_dotenv())    
    
openai.api_key  = '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'    

def get_completion(prompt, model="gpt-3.5-turbo"):    
    messages = [{"role": "user", "content": prompt}]    
    response = openai.ChatCompletion.create(    
        model=model,    
        messages=messages,    
        temperature=0,)                      
    return response.choices[0].message["content"]

def get_completion_from_messages(messages, model="gpt-3.5-turbo", temperature=0):
    response = openai.ChatCompletion.create(
        model=model,
        messages=messages,
        temperature=temperature, # this is the degree of randomness of the model's output
    )
#     print(str(response.choices[0].message))
    return response.choices[0].message["content"]

def get_base_prompt(base="python"):
    if base == "python":
        file_name = "py_base_prompt.txt"
    elif base == "test":
        file_name = "test_base_prompt.txt"
    else:
        file_name = "c_base_prompt.txt"
    with open(file_name, 'r') as f:
        base_prompt = f.read()
    return base_prompt

def get_mutate_prompt(base="python"):
    if base == "python":
        file_name = "py_mutation_prompt.txt"
    with open(file_name, 'r') as f:
        mutate_prompt = f.read()
    return mutate_prompt

def add_context(context, role, content):
    context.append({'role': role, 'content': content})
    response = get_completion_from_messages(context, temperature=0)
    context.append({'role': 'assistant', 'content': response})
    print(response)

def test(context):
    base_prompt = get_base_prompt("test")
    add_context(context, 'user', base_prompt)
    add_context(context, 'user', 'what is my name? Answer this question with 5 different responses.')
    print("context:")
    for i in context:
        print(i)
    print("last context:")
    print(context[-1]['content'])
    quit()

def main():
    context = [{'role': 'system', 'content': 'You are a generic assistant'}]
    base_prompt = get_base_prompt("python")
    #base_prompt = get_mutate_prompt("python")
    add_context(context, 'user', 'Here is a function and its corresponding\
            documentation. Respond with "yes" if you understand.\n' + 
                lib_help.get_doc_str())
    add_context(context, 'user', 'We are\
            going to perform security analysis on this function by fuzzing\
            the function.\n' + base_prompt + '\nImportant: ALWAYS import \
            sys, atheris, and the target library. Before using any \
            attributes, methods, or functions from libraries, make \
            sure to check if they exist and are accesible. \
            Try to avoid triggering an AttributeError. \
            Refer to the function documentation to avoid triggering \
            TypeErrors. Fuzz every parameter. Do not make generic \
            try/except blocks, only specific exceptions. \
            Prioritize high coverage via unique parameters/function calls. \
            Produce 5 unique fuzzing harnesses in Python. \
            Output format: harness_#.py: ```\\n <code> \\n```')
    #add_context(context, 'user', base_prompt)
    print("last\n\n\n")
    with open("llm_out.txt", "w") as f:
        f.write(context[-1]['content'])

if __name__ == "__main__":
    main()
