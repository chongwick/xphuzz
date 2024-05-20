import os
import config as cfg
import pickle
import fcntl #with fcntl, when another process tries to lock an already locked file -> poll

def write_file(file_path, content):
    with open(file_path, "w") as f:
        fcntl.flock(f.fileno(), fcntl.LOCK_EX)
        f.write(content)
        fcntl.flock(f.fileno(), fcntl.LOCK_UN)

def read_file(file_path):
    with open(file_path, "r") as f:
        content = f.read()
    return content
        
def dump_pickle(file_path, content):
    with open(file_path, "wb") as f:
        fcntl.flock(f.fileno(), fcntl.LOCK_EX)
        pickle.dump(content,f,protocol=pickle.HIGHEST_PROTOCOL)
        fcntl.flock(f.fileno(), fcntl.LOCK_UN)

def load_pickle(file_path):
    with open(file_path, "rb") as f:
        tmp = pickle.load(f)
    return tmp

def add_to_queue(queue_file, val, pos=None):
    queue_type = queue_file.split(".")[0]
    f = open(queue_file, "rb")
    fcntl.flock(f.fileno(), fcntl.LOCK_EX)
    queue = pickle.load(f)
    fcntl.flock(f.fileno(), fcntl.LOCK_UN)
    f.close()
    if pos != None:
        queue.insert(pos, val)
    else:
        queue.append(val)
    f = open(queue_file, "wb")
    fcntl.flock(f.fileno(), fcntl.LOCK_EX)
    pickle.dump(queue,f,protocol=pickle.HIGHEST_PROTOCOL)
    fcntl.flock(f.fileno(), fcntl.LOCK_UN)
    f.close()

def pop_from_queue(queue_file, pos=0):
    queue_type = queue_file.split(".")[0]
    f = open(queue_file, "rb")
    fcntl.flock(f.fileno(), fcntl.LOCK_EX)
    #os.path.getsize(queue_file) running out of input because file size is 0
    queue = pickle.load(f)
    fcntl.flock(f.fileno(), fcntl.LOCK_UN)
    f.close()
    if len(queue) == 0:
        return -1
    else:
        ret_val = queue.pop(pos)
        f = open(queue_file, "wb")
        fcntl.flock(f.fileno(), fcntl.LOCK_EX)
        pickle.dump(queue,f,protocol=pickle.HIGHEST_PROTOCOL)
        fcntl.flock(f.fileno(), fcntl.LOCK_UN)
        f.close()
        return ret_val

