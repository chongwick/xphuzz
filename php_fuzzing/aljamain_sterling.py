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
        seed_name = seed_name = seed.split("/")[1].split(".")[0]
        tmp[seed_name] = seed_data[seed_name]['coverage']
    coverages = {k: v for k, v in sorted(tmp.items(), key=lambda item: item[1])}
    return coverages

def pairing_aljo(gen_num, seed_data):
    if gen_num != 0:
        old_dir = 'gen_'+str(gen_num-1)
        directory = 'gen_'+str(gen_num)
        old_pool = [os.path.join(old_dir,x) for x in os.listdir(old_dir)]
        pool = [os.path.join(directory,x) for x in os.listdir(directory)]
        if len(pool) < len(old_pool):
            tmp_coverages = get_coverages(old_pool, seed_data)
            while len(pool) < len(old_pool):
                pool.append(os.path.join(old_dir,tmp_coverages.popitem()[0]))
        pairs = []
        coverages = get_coverages(pool,seed_data)
        #calculate top five percent
        a = len(coverages)/20
        a = int(a) if ((int(a) % 2) == 0) else int(a) + 1
        top_five = list(coverages.keys())[len(coverages)-a:]
        top_five_copy = top_five.copy()
        for i in top_five:
            del(coverages[i])
        the_rest = list(coverages.keys())
        the_rest_copy = the_rest.copy()

        count = 0
        while count < 2:
            while len(top_five) != 0:
                male = top_five.pop(random.randint(0,len(top_five)-1))
                female = top_five.pop(random.randint(0,len(top_five)-1))
                if seed_data[male]['parents'].intersection(
                        seed_data[female]['parents']):
                    tmp_fem = female
                    female = top_five.pop(random.randint(0,len(top_five)-1))
                    top_five.append(tmp_fem)
                pairs.append((male,female))
            top_five = top_five_copy
            while len(the_rest) != 0:
                male = the_rest.pop(random.randint(0,len(the_rest)-1))
                female = the_rest.pop(random.randint(0,len(the_rest)-1))
                if seed_data[male]['parents'].intersection(
                        seed_data[female]['parents']):
                    tmp_fem = female
                    female = the_rest.pop(random.randint(0,len(the_rest)-1))
                    the_rest.append(tmp_fem)
                pairs.append((male,female))
            the_rest = the_rest_copy
            count += 1
    else:
        directory = 'gen_'+str(gen_num)
        pool = [os.path.join(directory,x) for x in os.listdir(directory)]
        pairs = []
        coverages = get_coverages(pool,seed_data)
        a = len(coverages)/20
        a = int(a) if ((int(a) % 2) == 0) else int(a) + 1
        top_five = list(coverages.keys())[len(coverages)-a:]
        top_five_copy = top_five.copy()
        for i in top_five:
            del(coverages[i])
        the_rest = list(coverages.keys())
        the_rest_copy = the_rest.copy()
        count = 0
        while count < 2:
            while len(top_five) != 0:
                male = top_five.pop(random.randint(0,len(top_five)-1))
                female = top_five.pop(random.randint(0,len(top_five)-1))
                pairs.append((male,female))
            top_five = top_five_copy
            while len(the_rest) != 0:
                male = the_rest.pop(random.randint(0,len(the_rest)-1))
                female = the_rest.pop(random.randint(0,len(the_rest)-1))
                pairs.append((male,female))
            the_rest = the_rest_copy
            count += 1

    return pairs

seed_data = utils.load_pickle("seed_data.pickle")
pairing_aljo(0, seed_data)
