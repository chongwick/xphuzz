# Error parser may have to modified depending on the debug implementation used.
# The error is fed directly to the LLM. All we want from the error parser is the line of code
# with the ^^^ indicating the error and the error itself (e.g. "SyntaxError: Invalid or...").

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

def new_parse_error(error_file):
    with open(error_file, "r") as f:
        content = f.readlines()
    ret_content = ""
    error_message = False
    for i in content[1:]:
        if "    at " not in i:
            ret_content += i
        else:
            break;
    return ret_content
