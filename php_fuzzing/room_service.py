import os
import sys
import time

def main():
    dir_path = os.path.dirname(os.path.realpath(__file__))
    safe_files = os.listdir(dir_path)
    is_invalid = lambda x: not(x in safe_files or "gen" in x)
    while(True):
        time.sleep(5)
        cur_files = os.listdir(dir_path)
        for i in cur_files:
            if is_invalid(i):
                os.remove(os.path.join(dir_path,i))

if __name__ == "__main__":
    main()
