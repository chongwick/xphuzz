from generator import generate_samples
import os
import random
import secrets

def main():
    directory = "../gen_1"
    targets = os.listdir(directory)
    insertion_symbol = "\n<phpfuzz>\n"
    with open("template.php","r") as f:
        template = f.readlines()

    for tar in targets:
        outdir = "san_dir"
        outfile = os.path.join(outdir,secrets.token_hex(10) + ".php")
        tmp_copy = template
        with open(os.path.join(directory,tar),"r") as f:
            content = f.readlines()
        insertion_point = random.randint(1, len(content))
        content.insert(insertion_point,insertion_symbol)
        tmp_copy += content[1:]
        tmp_copy = "".join(tmp_copy)
        generate_samples(os.path.dirname(__file__), outfile, tmp_copy, 100)
        quit()

if __name__ == "__main__":
    main()
