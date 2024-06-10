import config as cfg
import pickle
from queue import Queue

with open(cfg.seed_data, "wb") as f:
    g = {}
    pickle.dump(g,f,pickle.HIGHEST_PROTOCOL)

with open(cfg.llm_queue, "wb") as f:
    g = Queue()
    pickle.dump(g,f,pickle.HIGHEST_PROTOCOL)

with open(cfg.cov_queue, "wb") as f:
    g = Queue()
    pickle.dump(g,f,pickle.HIGHEST_PROTOCOL)

with open(cfg.san_queue, "wb") as f:
    g = Queue()
    pickle.dump(g,f,pickle.HIGHEST_PROTOCOL)
