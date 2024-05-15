#Error parsing is done purely inside of the coverage enabled engine
#I don't know what it looks like when the sanitizer engine catches something

def is_error(string):
    if "error:" in string:
        return True
    else:
        return False

def parse_error(error, filename):
    g = error
    error = error.split("Stack trace:")[0] #Don't need the stack trace
    error = error.split("in /")
    spec = error[0]
    line_num = None
    if "on line " not in error[1]:
        line_num = error[1].split(":")[1]
    else:
        try:
            line_num = error[1].split("on line ")[1].split("\n")[0]
        except Exception as e:
            return spec
    with open(filename, "r") as f:
        content = f.readlines()
    if(line_num.isdigit()):
        error_line = content[int(line_num)-1] #weird offset
        return "{s}\n{e}".format(s=spec,e=error_line)
    else:
        return spec

