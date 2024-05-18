import sys
import os
import secrets

def format_directory(input_directory):
    nums = {}
    for i in os.listdir(input_directory):
        new_name = secrets.token_hex(10)
        while new_name in nums:
            new_name = secrets.token_hex(10)
        nums[new_name] = 1 
        os.rename(os.path.join(input_directory, i), 
                os.path.join(input_directory, new_name + ".js"))

def main():
    format_directory(sys.argv[1])

if __name__ == "__main__":
    main()
