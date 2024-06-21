from generator import generate_samples
import os
line = generate_samples(os.path.dirname(__file__),None,"<phpfuzz>",1,"no_guard_php.txt")
print(line)
