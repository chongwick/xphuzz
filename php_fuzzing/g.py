import config as cfg; import utils
import random
import math
import os
safe_files = utils.load_pickle(cfg.safe_files)
current_files = os.listdir(os.path.dirname(os.path.realpath(__file__)))
tmp = [i for i in current_files if (i not in safe_files and "blank.php" not in i and "gen_" not in i and "boot_" not in i)]
print(len(tmp))
#d = utils.load_pickle(cfg.seed_data)
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
#for i in os.listdir("gen_0"):
#    if i.split(".php")[0] not in d:
#        os.remove("gen_0/"+i)
