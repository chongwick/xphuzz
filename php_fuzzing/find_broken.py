import os
g = []
for i in os.listdir("php_corpus"):
    g.append(i.split(".")[0])

len(g)

h = []
for i in os.listdir("llm_requests"):
    if "_t" in i:
            h.append(i.split("_")[0])

len(h)

g = g + h
len(g)

for i in os.listdir("corpus"):
    if i.split(".")[0] not in g:
            print(i)

