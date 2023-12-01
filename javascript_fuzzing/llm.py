import openai    
import os
import tiktoken

class LLM_Instance:
    def __init__(self, context, temperature):
        self.context = context
        self.temperature = temperature
        from dotenv import load_dotenv, find_dotenv    
        _ = load_dotenv(find_dotenv())    
        openai.api_key  = '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'    

    def get_completion(self, prompt, model="gpt-3.5-turbo"):    
        messages = [{"role": "user", "content": prompt}]    
        response = openai.ChatCompletion.create(    
            model=model,    
            messages=messages,    
            temperature=self.temperature)                      
        return response.choices[0].message["content"]

    def get_completion_from_messages(self, messages, model="gpt-3.5-turbo"):
        response = openai.ChatCompletion.create(
            model=model,
            messages=messages,
            temperature=self.temperature, # this is the degree of randomness of the model's output
        )
    #     print(str(response.choices[0].message))
        return response.choices[0].message["content"]

    def add_context(self, role, content):
        self.context.append({'role': role, 'content': content})
        response = self.get_completion_from_messages(self.context)
        self.context.append({'role': 'assistant', 'content': response})
        print(response)

    def reset_context(self):
        self.context = [{'role': 'system', 'content': "You are a coding tool and \
                    reply ONLY with JAVASCRIPT CODE."}]

    def num_tokens_from_string(string, encoding_name="gpt-3.5-turbo"):
        encoding = tiktoken.encoding_for_model(encoding_name)
        num_tokens = len(encoding.encode(string))
        return num_tokens
