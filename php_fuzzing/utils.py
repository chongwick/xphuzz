import os
import config as cfg
import pickle

def enter_shared_dir(directory):                                                                      
    vacant_file=os.path.join(directory,"vacant")                                                      
    occupied_file=os.path.join(directory,"occupied")                                                  
    is_vacant = lambda : os.path.isfile(vacant_file)                                                  
    while not is_vacant():                                                                            
        pass                                                                                          
    os.rename(vacant_file, occupied_file)                                                             
                                                                                                      
def exit_shared_dir(directory):                                                                       
    vacant_file=os.path.join(directory,"vacant")                                                      
    occupied_file=os.path.join(directory,"occupied")                                                  
    os.rename(occupied_file, vacant_file)

def enter_seed_database():
    vacant_file = "seed_data_vacant"
    occupied_file = "seed_data_occupied"
    while not os.path.isfile(vacant_file):
        pass
    os.rename(vacant_file, occupied_file)

def exit_seed_database():
    vacant_file = "seed_data_vacant"
    occupied_file = "seed_data_occupied"
    os.rename(occupied, vacant_file)

def add_to_queue(queue_file, val, pos=-1):
    queue_type = queue_file.split(".")[0]
    occ = queue_type + "_occupied"
    vac = queue_type + "_vacant"
    while os.isfile(occ):
        pass
    os.rename(vac, occ)
    with open(queue_file, "rb") as f:
        queue = pickle.load(f)
    queue.insert(pos, val)
    with open(queue_file, "wb") as f:
        pickle.dump(queue,f,protocol=pickle.HIGHEST_PROTOCOL)
    os.rename(occ,vac)

def get_from_queue(pos):
    queue_type = queue_file.split(".")[0]
    occ = queue_type + "_occupied"
    vac = queue_type + "_vacant"
    while os.isfile(occ):
        pass
    os.rename(vac, occ)
    with open(queue_file, "rb") as f:
        queue = pickle.load(f)
    queue.pop(pos)
    with open(queue_file, "wb") as f:
        pickle.dump(queue,f,protocol=pickle.HIGHEST_PROTOCOL)
    os.rename(occ,vac)

