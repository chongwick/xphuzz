from transformers import AutoModelForCausalLM, AutoTokenizer, pipeline
checkpoint = "bigcode/starcoder"

model = AutoModelForCausalLM.from_pretrained(checkpoint)
tokenizer = AutoTokenizer.from_pretrained(checkpoint)

pipe = pipeline("text-generation", model=model, tokenizer=tokenizer, device=0)
print( pipe("def hello():") )
