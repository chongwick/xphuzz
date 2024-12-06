import config as cfg; import utils
import random
import math
import os
d = utils.load_pickle(cfg.seed_data)
#keys = list(d.keys())
#h = []
#bad = []
#for i in range(0,52):
#    keys.remove(str(i))
#print(len(keys))
#for i in range(228):
#    key = random.choice(keys)
#    keys.remove(key)
#    h.append(key)
#copy = list(d.keys())
#for i in h:
#    copy.remove(i)
#for i in copy:
#    del(d[i])
#utils.dump_pickle(cfg.seed_data,d)
for i in os.listdir("gen_0"):
    if i.split(".php")[0] not in d:
        os.remove("gen_0/"+i)
