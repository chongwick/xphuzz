import os
import random

php_seeds = [os.path.join("gen_0",i)for i in os.listdir("gen_0")]
pairs = {}

for i in os.listdir("gen_0"):
    name = "corpus/" + i.split(".")[0]+".js"
    pairs[name] = "gen_0/" + i

#for p,j in pairs.items():
#    with open(p,'r') as f:
#        php = f.read()
#    with open(j,'r') as f:
#        js = f.read()
#    print(php,js);quit()
#
g = random.choice(list(pairs.keys()))
with open(g,'r') as f:
    php = f.read()
with open("tmp","w") as f:
    f.write(php)
with open(pairs[g],'r') as f:
    js = f.read()
print(js)
