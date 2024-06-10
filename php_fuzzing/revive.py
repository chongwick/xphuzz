import receiver

with open("llm_requests/__output__","w") as f:
    f.write("<?php\necho \"did not work;\"\n?>")

role = 'You are a chatting assistant'
context = [{'role': 'system', 'content': role}]
llm = receiver.LLAMA3_LLM(context)
