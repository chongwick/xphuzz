import math
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

def new_scoring_function(seed_data):
    exclusions = [str(i) for i in range(36)]
    name_score={}
    crashers = []
    max_token_length = cfg.llama3_max/4-100
    scale_cov = 100
    scale_anc = 100
    data = seed_data.copy()
    w_cov = 1
    w_anc = 1
    w_anom = max([scale_cov,scale_anc]) * max([w_cov,w_anc]) * 2
    coverages = [data[i]['solo_cov'] for i in data if data[i]['solo_cov'] != None]
    min_cov = min(coverages)
    range_cov = max(coverages) - min(coverages)
    ancestry = [data[i]['ancestry'] for i in data if data[i]['ancestry'] != None]
    min_anc = min(ancestry)
    range_anc = max(ancestry) - min(ancestry)
    scores = 0
    for i in data:
        if i in exclusions:
            continue
        token_penalty = 1-data[i]['size']/max_token_length
        anom = int(data[i]['crash'] != 'NC')
        if anom != 0:
            crashers.append(i)
        if range_cov == 0:
            score_cov = 0
        else:
            score_cov = scale_cov * (
                    (data[i]['solo_cov']-min_cov)/range_cov)
        if range_anc == 0 or data[i]['generation'] == 0:
            score_anc = 0
        else:
            score_anc = scale_anc * (
                    (data[i]['ancestry']-min_anc)/range_anc)
        score = (token_penalty *
                 (w_cov*score_cov +
                  w_anc*score_anc +
                  w_anom*anom)
                 )
        name_score[i] = score
    score = {k: v for k, v in sorted(name_score.items(), key=lambda item: item[1], reverse=True)}
    ranking = [i for i in score]
    data_min = min([name_score[i] for i in score])
    data_max = max([name_score[i] for i in score])
    data_range = data_max - data_min
    scale = 5
    energy = [math.ceil(scale * (name_score[i]-data_min)/data_range) for i in score]
    name_energy = {k: v for (k,v) in zip(ranking,energy)}
    return (crashers, ranking, name_score, name_energy)
                  

def scoring_function(seed_data):
    data = seed_data.copy()
    solo_coverages = {}
    crashes = {}
    sizes = {}
    ranking = []
    score = {}
    crashers = []
    for i in data:
        if data[i]['crash'] != "NC" and data[i]['crash'] != None:
            crashers.append(i)
        else:
            if data[i]['solo_cov'] != None and os.path.exists(data[i]['php_file']):
                score[i] = data[i]['solo_cov']
    score = {k: v for k, v in sorted(score.items(), key=lambda item: item[1], reverse=True)}
    for i in score:
        ranking.append(i)
    loop_count = 0
    while loop_count < len(ranking):
        i = ranking[loop_count]
    #for i in ranking:
        if data[i]['size'] == None or data[i]['size'] >= cfg.llama3_max/4 - 100:
            ranking.remove(i)
        elif data[i]['time'] != None and data[i]['time'] >= cfg.query_time_limit:
            ranking.remove(i)
        loop_count += 1
    loop_count = 0
    while loop_count < len(crashers):
    #for i in crashers:
        i = crashers[loop_count]
        if data[i]['size'] == None or data[i]['size'] >= cfg.llama3_max/4 - 100:
            crashers.remove(i)
        if data[i]['time'] != None and data[i]['time'] >= cfg.query_time_limit:
            crashers.remove(i)
        loop_count += 1
    return (crashers,ranking)

#Assign fixes & determine ancestry scores
def new_aljo(gen_num, partitions, name_energy):
    boot = os.listdir("boot_"+str(gen_num+1))
    backup_boot = boot.copy()
    pairs = []
    crashers = partitions[0]
    ranking = partitions[1]
    ranking_copy = ranking.copy()
    if gen_num == 0 or len(crashers) == 0:
        crashers += [str(x) for x in range(len(os.listdir('native_crashers')))]
    for i in crashers:
        pairs.append((i,random.choice(boot)))
        #pairs.append((i,random.choice(ranking)))
    for i in ranking:
        energy = name_energy[i]//2
        while energy != 0:
            if energy % 2 == 0:
                male = i
                if len(ranking_copy) == 0:
                    ranking_copy = ranking.copy()
                female = random.choice(ranking_copy); ranking_copy.remove(female)
                pairs.append((male, female))
            else:
                male = i
                if len(boot) == 0:
                    boot = backup_boot.copy()
                female = random.choice(boot); boot.remove(female)
                pairs.append((male, female))
            energy -= 1
    return (pairs, crashers)

    ###new
    #if gen_num == 0:
    #    crashers += [str(x) for x in range(len(os.listdir('native_crashers')))]
    #if len(ranking) < 456:
    #    ranking += [x.split(".")[0] for x in os.listdir("gen_0") if 'er' not in x]
    #if len(ranking) < 456:
    #    ranking += [x.split(".")[0] for x in os.listdir("gen_0") if 'er' not in x]
    #for i in crashers:
    #    pairs.append((i,random.choice(boot)))
    #    pairs.append((i,random.choice(ranking)))
    #top_five = ranking[:len(ranking)//20]
    #backup_top_five = top_five.copy()
    #while len(top_five) > 2:
    #    male = random.choice(top_five); top_five.remove(male)
    #    female = random.choice(top_five); top_five.remove(female)
    #    if len(boot) < 2:
    #        boot = backup_boot.copy()
    #    second_male = random.choice(boot); boot.remove(second_male)
    #    second_female = random.choice(boot); boot.remove(second_female)
    #    pairs.append((male,female))
    #    pairs.append((male,second_female))
    #    pairs.append((female, second_male))
    #top_five = backup_top_five.copy()
    #boot = backup_boot.copy()
    #while len(ranking) > 2:
    #    male = random.choice(ranking); ranking.remove(male)
    #    female = random.choice(ranking); ranking.remove(female)
    #    if len(boot) < 2:
    #        boot = backup_boot.copy()
    #    second_male = random.choice(boot); boot.remove(second_male)
    #    second_female = random.choice(boot); boot.remove(second_female)
    #    pairs.append((male,female))
    #    pairs.append((male,second_female))
    #    pairs.append((female,second_male))
    #return pairs, crashers
    ###new


    #if gen_num == 0:
    #    crashers += [str(x) for x in range(len(os.listdir('native_crashers')))]
    #if len(crashers) < 2:
    #    crashers += cfg.og_crashers
    #Eventually, the context sizes of these things will be too big so we'll just put some
    #fresh meat in the grinder.
    if len(ranking) < 456:
        ranking += [x.split(".")[0] for x in os.listdir("gen_0") if 'er' not in x]
        #crashers += [str(x) for x in range(len('native_crashers'))]
    #for i in crashers:
    #    tmp = crashers.copy()
    #    tmp.remove(i)
    #    pairs.append((i,random.choice(tmp)))
    #pairs += [(x, random.choice(ranking[:len(crashers)])) for x in crashers]
    #pairs += [(x, random.choice(boot)) for x in crashers]
    top_five = ranking[:len(ranking)//20]
    for i in top_five:
        if len(crashers) != 0:
            pairs.append((i,random.choice(crashers)))
        pairs.append((i,random.choice(top_five)))
    pairs += [(x, random.choice(boot)) for x in ranking]
    while len(ranking) > 2:
        male = random.choice(ranking)
        ranking.remove(male)
        female = random.choice(ranking)
        ranking.remove(female)
        pairs.append((male,female))
    return pairs, crashers
    #boot = os.listdir("boot_"+str(gen_num+1))
    #pairs = []
    #crashers = partitions[0]
    #ranking = partitions[1]
    #if len(crashers) < 2:
    #    crashers += cfg.og_crashers
    ##Eventually, the context sizes of these things will be too big so we'll just put some
    ##fresh meat in the grinder.
    #if len(crashers) + len(ranking) < 456:
    #    ranking += [x.split(".")[0] for x in os.listdir("gen_0")]
    #for i in crashers:
    #    tmp = crashers.copy()
    #    tmp.remove(i)
    #    pairs.append((i,random.choice(tmp)))
    #pairs += [(x, random.choice(ranking[:len(crashers)])) for x in crashers]
    #pairs += [(x, random.choice(boot)) for x in crashers]
    #pairs += [(x, random.choice(boot)) for x in ranking]
    #while len(ranking) > 2:
    #    male = random.choice(ranking)
    #    ranking.remove(male)
    #    female = random.choice(ranking)
    #    ranking.remove(female)
    #    pairs.append((male,female))
    #return pairs, crashers
    

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

#print(new_scoring_function(utils.load_pickle(cfg.seed_data))[1])
#print(len(pairing_aljo(1, 'boot_2')))
