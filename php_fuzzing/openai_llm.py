import openai    
import os
import tiktoken
import config as cfg


class LLM_Instance:
    def __init__(self, context, temperature):
        self.context = context
        self.original_context = self.context.copy()
        self.temperature = temperature
        self.token_count = self.num_tokens_from_string(self.context[0]['content'])
        self.dollar_cost = lambda x,y: x * 0.000001 if y == "input" else x * 0.000002
        self.running_cost = self.dollar_cost(self.token_count, "input") #Initial context
        from dotenv import load_dotenv, find_dotenv    
        _ = load_dotenv(find_dotenv())    
        #openai.api_key  = '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'    
        #openai.api_key  = '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'    
        openai.api_key  = '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'

    def change_temperature(self, temperature):
        self.temperature = temperature
        return

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
        tokens = self.num_tokens_from_string(content)
        self.token_count += tokens
        self.running_cost += self.dollar_cost(tokens, "input")
        if self.token_count > cfg.token_max:
            self.reset_context()
            raise RuntimeError("Exceeded Max Tokens ({m}): {t}".format(m=cfg.token_max,
                                                                       t=self.token_count))
        response = self.get_completion_from_messages(self.context)
        tokens = self.num_tokens_from_string(response)
        self.token_count += tokens
        self.running_cost += self.dollar_cost(tokens, "output")
        self.context.append({'role': 'assistant', 'content': response})
        print(response)

    def reset_context(self):
        self.context = self.original_context.copy()
        self.token_count = self.num_tokens_from_string(self.context[0]['content'])
        old_cost = self.running_cost
        self.running_cost = self.dollar_cost(self.token_count, "input") #Initial context
        return old_cost

    def change_role(self, role_description):
        self.context = [{'role': 'system', 'content': role_description}]
        return

    def num_tokens_from_string(self, string, encoding_name="cl100k_base"):
        encoding = tiktoken.get_encoding(encoding_name)
        num_tokens = len(encoding.encode(string))
        return num_tokens

context = [{'role': 'system', 'content': 'you are a chatter'}]
llm = LLM_Instance(context, 1)
llm.add_context("user", "HI")
