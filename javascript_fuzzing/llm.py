import openai    
import os
import tiktoken

TOKEN_MAX=4097

class LLM_Instance:
    def __init__(self, context, temperature):
        self.context = context
        self.original_context = self.context.copy()
        self.temperature = temperature
        self.token_count = self.num_tokens_from_string(self.context[0]['content'])
        from dotenv import load_dotenv, find_dotenv    
        _ = load_dotenv(find_dotenv())    
        #openai.api_key  = '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'    
        openai.api_key  = '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'    

    def change_temperature(self, temperature):
        self.temperature = temperature

    def get_completion(self, prompt, model="gpt-3.5-turbo"):    
        messages = [{"role": "user", "content": prompt}]    
        response = openai.chat.completions.create(    
            model=model,    
            messages=messages,    
            temperature=self.temperature)                      
        return response.choices[0].message.content.strip()
        #return response.choices[0].message["content"]

    def get_completion_from_messages(self, messages, model="gpt-3.5-turbo"):
        response = openai.chat.completions.create(
            model=model,
            messages=messages,
            temperature=self.temperature, # this is the degree of randomness of the model's output
        )
    #     print(str(response.choices[0].message))
        return response.choices[0].message.content.strip()
        #return response.choices[0].message["content"]

    def add_context(self, role, content):
        self.context.append({'role': role, 'content': content})
        self.token_count += self.num_tokens_from_string(content)
        if self.token_count > TOKEN_MAX:
            self.reset_context()
            raise RuntimeError("Exceeded Max Tokens ({m}): {t}".format(m=TOKEN_MAX,
                                                                       t=self.token_count))
        response = self.get_completion_from_messages(self.context)
        self.token_count += self.num_tokens_from_string(response)
        self.context.append({'role': 'assistant', 'content': response})
        print(response)

    def reset_context(self):
        self.context = self.original_context.copy()
        self.token_count = self.num_tokens_from_string(self.context[0]['content'])

    def num_tokens_from_string(self, string, encoding_name="cl100k_base"):
        #encoding = tiktoken.encoding_for_model(encoding_name)
        encoding = tiktoken.get_encoding(encoding_name)
        num_tokens = len(encoding.encode(string))
        return num_tokens
