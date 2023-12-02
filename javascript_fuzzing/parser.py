def parse_structures(in_file):
    loop_keywords = ["for", "do", "while"]
    conditional_keywords = ["if", "else", "else if", "switch"]
    function_keyword = "function"
    match_do_while = False
    loops = []
    conditionals = []
    functions = []
    with open(in_file, "r") as f:
        content = f.readlines()
    for num, line in enumerate(content):
        if "//" not in line:
            if any(word in line for word in loop_keywords):
                if match_do_while and "while" in line:
                    match_do_while = False
                else:
                    loops.append((num, line))
                if ("do" in line):
                    match_do_while = True
            elif any(word in line for word in conditional_keywords):
                conditionals.append((num, line))
            elif function_keyword in line:
                functions.append((num, line))
    return loops, conditionals, functions

