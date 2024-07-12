import random
import os
import utils
import config as cfg

'''
The top 5 percent of each generation are bred with each other exclusively.
We want the same generation size. i.e. gen_0's size. If a generation 
does not reach this size due to issues with fixing, we draw back from
the highest performers of the previous generation. Everybody breeds twice
'''
def get_coverages(pool, seed_data):
    tmp = {}
    for seed in pool:
        seed_name = seed.split("/")[1].split(".")[0]
        tmp[seed_name] = seed_data[seed_name]['coverage']
    coverages = {k: v for k, v in sorted(tmp.items(), key=lambda item: item[1])}
    return coverages

def new_aljo(gen_num, partitions):
    boot = os.listdir("boot_"+str(gen_num+1))
    pairs = []
    crashers = partitions[0]
    ranking = partitions[1]
    if len(crashers) < 2:
        crashers += cfg.og_crashers
    #Eventually, the context sizes of these things will be too big so we'll just put some
    #fresh meat in the grinder.
    if len(crashers) + len(ranking) < 456:
        ranking += [x.split(".")[0] for x in os.listdir("gen_0")]
    for i in crashers:
        tmp = crashers.copy()
        tmp.remove(i)
        pairs.append((i,random.choice(tmp)))
    pairs += [(x, random.choice(ranking[:len(crashers)])) for x in crashers]
    pairs += [(x, random.choice(boot)) for x in crashers]
    pairs += [(x, random.choice(boot)) for x in ranking]
    while len(ranking) > 2:
        male = random.choice(ranking)
        ranking.remove(male)
        female = random.choice(ranking)
        ranking.remove(female)
        pairs.append((male,female))
    return pairs
    

def pairing_aljo(gen_num, boot_gen):
    seed_data = utils.load_pickle(cfg.seed_data)
    boot_corp = os.listdir(boot_gen)
    if gen_num != 0:
        old_dir = 'gen_'+str(gen_num-1)
        directory = 'gen_'+str(gen_num)
        old_pool = [os.path.join(old_dir,x) for x in os.listdir(old_dir)]
        pool = [os.path.join(directory,x) for x in os.listdir(directory)]
        tmp_list = []
        for i in old_pool:
            seed_name = i.split("/")[1].split(".")[0]
            if seed_name in seed_data:
                tmp_list.append(i)
        old_pool = tmp_list.copy()
        tmp_list = []
        for i in pool:
            seed_name = i.split("/")[1].split(".")[0]
            if seed_name in seed_data:
                tmp_list.append(i)
        pool = tmp_list.copy()
        del(tmp_list)
        if len(pool) < len(old_pool):
            tmp_coverages = get_coverages(old_pool, seed_data)
            while len(pool) < len(old_pool):
                pool.append(os.path.join(old_dir,tmp_coverages.popitem()[0]))
        pairs = []
        coverages = get_coverages(pool,seed_data)
        total = list(coverages.keys())
        #calculate top five percent
        a = len(coverages)/20
        a = int(a) if ((int(a) % 2) == 0) else int(a) + 1
        top_five = list(coverages.keys())[len(coverages)-a:]
        #top_five_copy = top_five.copy()
        for i in top_five:
            del(coverages[i])
        the_rest = list(coverages.keys())
        #the_rest_copy = the_rest.copy()
        while len(top_five) != 0:
            male = top_five.pop(random.randint(0,len(top_five)-1))
            female = top_five.pop(random.randint(0,len(top_five)-1))
            if seed_data[male]['parents'] != None and (
                    seed_data[female]['parents'] != None):
                if seed_data[male]['parents'].intersection(
                        seed_data[female]['parents']):
                    tmp_fem = female
                    female = top_five.pop(random.randint(0,len(top_five)-1))
                    top_five.append(tmp_fem)
            pairs.append((male,female))
        while len(the_rest) != 0:
            male = the_rest.pop(random.randint(0,len(the_rest)-1))
            female = the_rest.pop(random.randint(0,len(the_rest)-1))
            if seed_data[male]['parents'] != None and (
                    seed_data[female]['parents'] != None):
                if seed_data[male]['parents'].intersection(
                        seed_data[female]['parents']):
                    tmp_fem = female
                    female = the_rest.pop(random.randint(0,len(the_rest)-1))
                    the_rest.append(tmp_fem)
            pairs.append((male,female))
        while len(total) != 0:
            male = total.pop()
            female = boot_corp.pop()
            pairs.append((male,female))
    else:
        directory = 'gen_'+str(gen_num)
        pool = [os.path.join(directory,x) for x in os.listdir(directory)]
        pairs = []
        tmp_list = []
        for i in pool:
            seed_name = i.split("/")[1].split(".")[0]
            if seed_name in seed_data:
                tmp_list.append(i)
        pool = tmp_list.copy()
        del(tmp_list)
        coverages = get_coverages(pool,seed_data)
        total = list(coverages.keys())
        a = len(coverages)/20
        a = int(a) if ((int(a) % 2) == 0) else int(a) + 1
        top_five = list(coverages.keys())[len(coverages)-a:]
        for i in top_five:
            del(coverages[i])
        the_rest = list(coverages.keys())
        while len(top_five) != 0:
            male = top_five.pop(random.randint(0,len(top_five)-1))
            female = top_five.pop(random.randint(0,len(top_five)-1))
            pairs.append((male,female))
        while len(the_rest) != 0:
            male = the_rest.pop(random.randint(0,len(the_rest)-1))
            female = the_rest.pop(random.randint(0,len(the_rest)-1))
            pairs.append((male,female))
        while len(total) != 0:
            male = total.pop()
            female = boot_corp.pop()
            pairs.append((male,female))


    return pairs

#print(len(pairing_aljo(1, 'boot_2')))
