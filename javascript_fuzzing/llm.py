import openai    
import os
import tiktoken
import formatter

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

def get_base_prompt(base="java"):
    if base == "python":
        file_name = "py_base_prompt.txt"
    elif base == "test":
        file_name = "test_base_prompt.txt"
    elif base == "java":
        file_name = "java_base_prompt.txt"
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
    response = get_completion_from_messages(context, temperature=1)
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

#Five primitive operations
def combine(snippet_list, context, output_file):
    segments = ""
    for snip in snippet_list:
        with open(snip, "r") as f:
            segments += f.read()
        segments += "\n\n"
    out_str = segments + "\n Intermingle these pieces of code"
    add_context(context, 'user', out_str) 
    with open(output_file, "w") as f:
        f.write(context[-1]['content'])

def complicate(snippet, context, output_file):
    with open(snippet, "r") as f:
        snippet = f.read()
    add_context(context, 'user', "Make this more complicated:\n" + snippet)
    with open(output_file, "w") as f:
        f.write(context[-1]['content'])

def inject(snippet, context, output_file):
    with open(snippet, "r") as f:
        snippet = f.read()
    add_context(context, 'user', "Use more JavaScript function:\n" + snippet)
    with open(output_file, "w") as f:
        f.write(context[-1]['content'])

def fix(error, context, output_file):
    with open(error, "r") as f:
        snippet = f.read()
    add_context(context, 'user', error)
    with open(output_file, "w") as f:
        f.write(context[-1]['content'])

def extend(snippet, context, output_file):
    with open(snippet, "r") as f:
        snippet = f.read()
    add_context(context, 'user', "Add to this:\n" + snippet)
    with open(output_file, "w") as f:
        f.write(context[-1]['content'])

def num_tokens_from_string(string: str, encoding_name="gpt-3.5-turbo") -> int:
    encoding = tiktoken.encoding_for_model(encoding_name)
    num_tokens = len(encoding.encode(string))
    return num_tokens

def main():
    formatter = Formatter()
    context = [{'role': 'system', 'content': "You are a coding tool and \
                reply ONLY with JAVASCRIPT CODE."}]
    output_file = "output.js"
    #combine([output_file, "snippets/snippet3"], context, output_file)
    #complicate("snippets/snippet",context, output_file)
    complicate(output_file, context, output_file)
    #extend(output_file, context, output_file)
    #extend("snippet2",context)
    #base_prompt = get_base_prompt("java")
    #add_context(context, 'user', base_prompt)

    #with open("llm_out.txt", "w") as f:
    #    f.write(context[-1]['content'])
    #with open("mutation_out.txt", "w") as f:
    #    f.write(context[-1]['content'])

if __name__ == "__main__":
    main()
