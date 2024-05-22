import os
import config as cfg
import pickle
import fcntl #with fcntl, when another process tries to lock an already locked file -> poll
from filelock import FileLock

#Special queue operations because they're tricky
#is_busy = lambda queue : os.path.isfile(cfg.status_file[queue])
#lock = lambda queue : with open(cfg.status_file[queue],"w") as f: pass
#unlock = lambda queue : os.remove(cfg.status_file[queue])

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
    lock = FileLock(cfg.status[queue_file], timeout=-1)
    with lock:
        with open(queue_file, "rb") as f:
            queue = pickle.load(f)
        if pos != None:
            queue.insert(pos, val)
        else:
            queue.append(val)
        with open(queue_file, "wb") as f:
            pickle.dump(queue,f,protocol=pickle.HIGHEST_PROTOCOL)



    #f = open(queue_file, "rb")
    #fcntl.flock(f.fileno(), fcntl.LOCK_EX)
    #while os.path.getsize(queue_file) == 0:
    #    pass
    #queue = pickle.load(f)
    #fcntl.flock(f.fileno(), fcntl.LOCK_UN)
    #f.close()
    #if pos != None:
    #    queue.insert(pos, val)
    #else:
    #    queue.append(val)
    #f = open(queue_file, "wb")
    #fcntl.flock(f.fileno(), fcntl.LOCK_EX)
    #pickle.dump(queue,f,protocol=pickle.HIGHEST_PROTOCOL)
    #fcntl.flock(f.fileno(), fcntl.LOCK_UN)
    #f.close()

def pop_from_queue(queue_file, pos=0):
    lock = FileLock(cfg.status[queue_file], timeout=-1)
    with lock:
        with open(queue_file,"rb") as f:
            queue = pickle.load(f)
            if len(queue) == 0:
                ret_val = -1
            else:
                ret_val = queue.pop(pos)
                with open(queue_file, "wb") as f:
                    pickle.dump(queue,f,protocol=pickle.HIGHEST_PROTOCOL)
    return ret_val

    #f = open(queue_file, "rb")
    #fcntl.flock(f.fileno(), fcntl.LOCK_EX)
    #while os.path.getsize(queue_file) == 0:
    #    pass
    #while(True):
    #    try:
    #        queue = pickle.load(f)
    #        break;
    #    except Exception as e:
    #        pass
    #fcntl.flock(f.fileno(), fcntl.LOCK_UN)
    #f.close()
    #if len(queue) == 0:
    #    unlock(queue_file)
    #    return -1
    #else:
    #    ret_val = queue.pop(pos)
    #    f = open(queue_file, "wb")
    #    fcntl.flock(f.fileno(), fcntl.LOCK_EX)
    #    pickle.dump(queue,f,protocol=pickle.HIGHEST_PROTOCOL)
    #    fcntl.flock(f.fileno(), fcntl.LOCK_UN)
    #    f.close()
    #    return ret_val

