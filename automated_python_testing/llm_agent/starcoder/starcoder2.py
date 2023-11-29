from transformers import AutoModelForCausalLM, AutoTokenizer, GenerationConfig

# Define the checkpoint for the Code Llama model
checkpoint = "bigcode/starcoder"

# Specify the device for model execution (e.g., GPU - "cuda" or CPU - "cpu")
device = "cpu"

# Initialize the tokenizer using the specified checkpoint
tokenizer = AutoTokenizer.from_pretrained(checkpoint)

# Load the pre-trained model and move it to the specified device (GPU)
model = AutoModelForCausalLM.from_pretrained(checkpoint).to(device)

# Configure the generation settings for the model
generation_config = GenerationConfig(
    temperature=0.2,  # Temperature parameter for controlling randomness
    top_k=50,         # Top-k parameter for sampling
    top_p=0.95,       # Top-p parameter for sampling
    repetition_penalty=1.2,  # Repetition penalty to discourage repeated tokens
    do_sample=True,   # Enable sampling instead of greedy decoding
    pad_token_id=tokenizer.eos_token_id,  # Define the pad token ID
    eos_token_id=tokenizer.convert_tokens_to_ids("<|end|>"),  # Define the EOS token ID
    min_new_tokens=32,  # Minimum number of new tokens in generated output
    max_new_tokens=1024,  # Maximum number of new tokens in generated output
)

#prompt to model
prompt = "Human: I have a CSV file that looks like this:\
'Name,Salary'\
'Bob,12000'\
'Avantika,35000'\
'Alice,30000'\
Write a program that returns the name of the person with the highest salary"

# Encode the input text "def fibonacci(n):" using the tokenizer and move it to the device
inputs = tokenizer.encode(prompt, return_tensors="pt").to(device)

# Generate text based on the input using the configured generation settings
outputs = model.generate(inputs, generation_config=generation_config)

# Decode and print the generated text
print(tokenizer.decode(outputs[0]))

