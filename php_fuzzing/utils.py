import os
import config as cfg
import pickle
import fcntl #with fcntl, when another process tries to lock an already locked file -> poll

def write_file(file_path, content):
    f = open(file_path, "w")
    fcntl.flock(f.fileno(), fcntl.LOCK_EX)
    f.write(content)
    fcntl.flock(f.fileno(), fcntl.LOCK_UN)
    f.close()

def read_file(file_path):
    f = open(file_path, "r")
    fcntl.flock(f.fileno(), fcntl.LOCK_EX)
    while os.path.getsize(file_path) == 0:
        pass
    content = f.read()
    fcntl.flock(f.fileno(), fcntl.LOCK_UN)
    f.close()
    return content
        
def dump_pickle(file_path, content):
    f = open(file_path, "wb")
    fcntl.flock(f.fileno(), fcntl.LOCK_EX)
    pickle.dump(content,f,protocol=pickle.HIGHEST_PROTOCOL)
    fcntl.flock(f.fileno(), fcntl.LOCK_UN)
    f.close()

def load_pickle(file_path):
    f = open(file_path, "rb")
    fcntl.flock(f.fileno(), fcntl.LOCK_EX)
    while os.path.getsize(file_path) == 0:
        pass
    tmp = pickle.load(f)
    fcntl.flock(f.fileno(), fcntl.LOCK_UN)
    f.close()
    return tmp

def add_to_queue(queue_file, val, pos=None):
    queue_type = queue_file.split(".")[0]
    f = open(queue_file, "rb")
    fcntl.flock(f.fileno(), fcntl.LOCK_EX)
    while os.path.getsize(queue_file) == 0:
        pass
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
    while os.path.getsize(queue_file) == 0:
        pass
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

