import time
import config as cfg
import os

count = 0
while count < 24:
    with open(cfg.time_file, "w") as f:
        f.write(str(count))
    time.sleep(3600/2)
    count += 1
count = -1
with open(cfg.time_file, "w") as f:
    f.write(str(count))
