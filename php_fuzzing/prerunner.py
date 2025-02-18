import config as cfg; import utils; import request_handler
import subprocess
utils.dump_pickle(cfg.init_corpus,request_handler.load_seed_corpus("nightly_php"))
command = ['bash','./linker.sh',"nightly_php",cfg.includes]
subprocess.run(command,text=True,timeout=40,capture_output=True)
