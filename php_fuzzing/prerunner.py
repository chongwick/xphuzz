import os
import config as cfg; import utils
import subprocess

#def load_seed_corpus(seed_corpus_directory):
#    command = ['bash','./corpus_loader.sh',seed_corpus_directory]
#    subprocess.run(command,text=True,timeout=40,capture_output=True)
#    with open("tmp_files.txt",'r') as f:
#        files = f.readlines()
#    os.remove("tmp_files.txt")
#    return [i.split("\n")[0] for i in files]

def load_seed_corpus(seed_corpus_directory):
    return [os.path.join(seed_corpus_directory,i) for i in os.listdir(seed_corpus_directory)]


utils.dump_pickle(cfg.init_corpus,load_seed_corpus("init_corpus"))
#command = ['bash','./linker.sh',"nightly_php",cfg.includes]
#subprocess.run(command,text=True,timeout=40,capture_output=True)
