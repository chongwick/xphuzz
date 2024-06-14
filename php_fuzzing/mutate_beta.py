#This one will run constantly in the background
from generator import generate_samples
import os
import random
import secrets
import config as cfg
import utils

def main():
    directory = "gen_1"
    targets = os.listdir(directory)
    insertion_symbol = "\n<phpfuzz>\n"
    with open("template.php","r") as f:
        template = f.readlines()
    for tar in targets:
        outdir = "san_dir"
        #outfile = os.path.join(outdir,secrets.token_hex(10) + ".php")
        outfile = os.path.join(outdir,tar+"_M")
        tmp_copy = template.copy()
        with open(os.path.join(directory,tar),"r") as f:
            content = f.readlines()
        insertion_point = random.randint(1, len(content)-1)
        content.insert(insertion_point,insertion_symbol)
        tmp_copy += content[1:]
        tmp_copy = "".join(tmp_copy)
        generate_samples(os.path.dirname(__file__), outfile, tmp_copy, 10)

if __name__ == "__main__":
    main()
