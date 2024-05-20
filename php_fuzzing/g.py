import pickle,fcntl
f = open("g.pickle","rb")
fcntl.flock(f.fileno(), fcntl.LOCK_EX)
i = pickle.load(f)
print(i)
print("don")
