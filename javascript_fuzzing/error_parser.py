flag_error = "SyntaxError: Unexpected identifier \'flag\'"
def parse_error(error_file):
    with open(error_file, "r") as f:
        content = f.readlines()
    ret_content = ""
    error_message = False
    for i in content:
        if "Error" in i and "fuzzcode" in i and flag_error not in i:
            error_message = True
        elif "Error" in i and "fuzzcode" not in i:
             break;
        if error_message:
            ret_content += i
    return ret_content

