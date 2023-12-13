import sys
def coverage_affected():
    return 

def get_content_without_strings(content):
    for string_character in ['"', "'", "`"]:     # currently I don't try regex strings
        fixed_code = ""
        code_to_fix = content
        while True:
            index = speed_optimized_functions.get_index_of_next_symbol_not_within_string(code_to_fix, string_character)
            if index == -1:
                break
            rest = code_to_fix[index+1:]
            end_index = speed_optimized_functions.get_index_of_next_symbol_not_within_string(rest, string_character)
            if end_index == -1:
                break
            fixed_code = fixed_code + code_to_fix[:index] + string_character+string_character
            code_to_fix = code_to_fix[index+1+1+end_index:]
        content = fixed_code + code_to_fix
    return content

def get_variable_name_candidates(content):
    content = get_content_without_strings(content)  # ensure that variable_tokens are not taken from strings
    content = get_content_without_special_chars_exclude_dot(content, " ")
    parts = content.split(" ")

    allowed_words = ["function", "class", "object", "array", "set", "async", "await", "break", "case", "class", "catch", "const", "continue", "debugger", "default", "delete", "do", "else", "enum", "export", "extends", "finally", "for", "function", "if", "implements", "import", "in", "interface", "instanceof", "let", "new", "package", "private", "protected", "public", "return", "static", "super", "switch", "this", "throw", "try", "typeof", "var", "void", "while", "with", "yield", "Object", "Function", "Boolean", "Error", "Number", "Date", "String", "RegExp", "Array", "Map", "Set", "WeakMap", "WeakSet", "ArrayBuffer", "SharedArrayBuffer", "Intl.Collator", "Intl.DateTimeFormat", "Intl.ListFormat", "Intl.NumberFormat", "Intl.PluralRules", "Intl.RelativeTimeFormat", "Object",
                     "Function",
                     "Boolean",
                     "Error",
                     "EvalError",
                     "InternalError",
                     "RangeError",
                     "ReferenceError",
                     "SyntaxError",
                     "TypeError",
                     "URIError",
                     "Number",
                     "Date",
                     "String",
                     "RegExp",
                     "Array",
                     "Int8Array",
                     "Uint8Array",
                     "Uint8ClampedArray",
                     "Int16Array",
                     "Uint16Array",
                     "Int32Array",
                     "Uint32Array",
                     "Float32Array",
                     "Float64Array",
                     "BigUint64Array",
                     "BigInt64Array",
                     "Map",
                     "Set",
                     "WeakMap",
                     "WeakSet",
                     "ArrayBuffer",
                     "SharedArrayBuffer",
                     "Intl.Collator",
                     "Intl.DateTimeFormat",
                     "Intl.ListFormat",
                     "Intl.NumberFormat",
                     "Intl.PluralRules",
                     "Intl.RelativeTimeFormat",
                     "DataView",
                     "Proxy",
                     "Promise",
                     "Symbol",
                     "Intl.Locale",
                     "WebAssembly.Table",
                     "eval",
                     "isFinite",
                     "isNaN",
                     "parseFloat",
                     "parseInt",
                     "decodeURI",
                     "decodeURIComponent",
                     "encodeURI",
                     "encodeURIComponent",
                     "escape",
                     "unescape",
                     "Math",
                     "Atomics",
                     "JSON",
                     "Reflect",
                     "globalThis",
                     "Intl",
                     "BigInt",
                     "WebAssembly",
                     "Module",
                     "Instance",
                     "Memory",
                     "Table",
                     "CompileError",
                     "LinkError",
                     "RuntimeError",
                     "Infinity",
                     "NaN",
                     "Symbol",
                     "console",
                     "printErr",
                     "write",
                     "performance",
                     "setTimeout",
                     "Worker",
                     "optimizefunctiononnextcall",
                     "preparefunctionforoptimization",
                     "isconcurrentrecompilationsupported",
                     "clearfunctionfeedback",
                     "optimizeosr",
                     "undefined",
                     "true",
                     "false",
                     "arguments",
                     "constructor",
                     "arraybufferneuter",
                     "simulatenewspacefull",
                     "null",
                     "gc",
                     "print",
                     "isbeinginterpreted",
                     "of",
                     "arraybufferdetach",
                     "unblockconcurrentrecompilation",
                     "heapobjectverify",
                     "neveroptimizefunction",
                     "tostring",
                     "slow_sloppy_arguments_elements",
                     "valueof",
                     "then",
                     "getownpropertydescriptor",
                     "deleteproperty",
                     "setprototypeof",
                     "ownkeys",
                     "deoptimizenow",
                     "constructor",
                     "__proto__"]

    allowed_words2 = []
    for allowed_word in allowed_words:
        allowed_word = allowed_word.lower()
        if allowed_word not in allowed_words2:
            allowed_words2.append(allowed_word)
    allowed_words = allowed_words2

    tmp_ret = set()
    for part in parts:
        part = part.lower()
        if part == "":
            continue
        if "." in part:
            continue    # skip properties!
        if part in allowed_words:
            continue
        if part.startswith("var_") or part.startswith("func_") or part.startswith("cl_"):
            continue
        if part.isnumeric():
            continue
        if part.endswith("n"):
            part2 = part[:-1]
            if part2.isnumeric():
                continue
        if "e" in part:
            part2 = part.replace("e", "")
            if part2.isnumeric():
                continue
        if "0x" in part:
            part2 = part.replace("0x", "")
            part2 = part2.replace("a", "")
            part2 = part2.replace("b", "")
            part2 = part2.replace("c", "")
            part2 = part2.replace("d", "")
            part2 = part2.replace("e", "")
            part2 = part2.replace("f", "")
            part2 = part2.replace("n", "")   # they can also be big ints
            if part2.isnumeric() or part2 == "":
                continue
        if "0b" in part:
            part2 = part.replace("0b", "")
            part2 = part2.replace("n", "")   # they can also be big ints
            if part2.isnumeric():
                continue
        tmp_ret.add(part)

    return tmp_ret

def get_content_without_special_chars(content):
    # TODO: Note: I later added ' (single quot) and didn't test it afterwards
    # if it fails at some point it's maybe because of the added single quot!
    special_chars = "()\t,;={}[]/\\:.<@>!?&+-~'%$^*|\"`\n"   # important: Don't add "_" because "_" can also occur in a variable name
    # important: I replace special chars with a space instead of removing them to keep the same offsets
    content_test = content
    for char in special_chars:
        content_test = content_test.replace(char, " ")
    return content_test

def contains_only_valid_token_characters(token):
    for c in token:
        if c.isalnum() is False and c != "_":
            return False
    return True

def get_all_variable_names_in_testcase(content):
    variable_names_to_rename = set()
    for line in content.split("\n"):
        line = line.strip()

        if "let " in line or "var " in line or "const " in line:
            # if line.startswith("let ") or line.startswith("var ") or line.startswith("const "):
            # right_side = line.replace('\t',' ').split(" ",1)[1]
            splitter = " "
            if "let " in line:
                splitter = "let "
            elif "var " in line:
                splitter = "var "
            elif "const " in line:
                splitter = "const "
            # print("Line: %s" % line)
            right_side = line.split(splitter, 1)[1]
            # print("Right side: %s" % right_side)
            # We must also handle cases with something like:
            # let { x: [y], } = { x: [45] };
            # Or:
            # let [...{ length }] = [1, 2, 3];
            # wtf, why is this valid code?

            variable_name = right_side
            variable_name = variable_name.replace("[", "").replace("]", "").replace("(", "").replace(")", "").replace("{", "").replace("}", "").replace(".", "")

            # Handle cases like:
            # var [...[x, y, z]] = [3, 4, 5];
            test = variable_name.split("=")[0]
            # print("TEST IS: %s" % test)
            if "," in test:
                test3 = test.replace(';', ' ').replace(':', ' ')
                for x in test3.split(','):
                    x = x.strip()
                    # print("Variable2 name to add: %s" % x)
                    variable_names_to_rename.add(x)

                test4 = test.replace(';', ',').replace(':', ',')
                for x in test4.split(','):
                    x = x.strip()
                    # print("Variable2 name to add: %s" % x)
                    variable_names_to_rename.add(x)
            else:
                variable_name = variable_name.replace('=', ' ').replace(';', ' ').replace(':', ' ').strip()
                if variable_name == "":
                    continue
                variable_name = variable_name.split()[0]
                # print("Variable name to add: %s" % variable_name.strip())
                variable_names_to_rename.add(variable_name.strip())

        elif "=" in line:
            idx = line.index("=")
            try:
                symbol_afterwards = line[idx + 1]
            except:
                symbol_afterwards = None
            if symbol_afterwards in ["=", "!", ">"]:
                continue

            left_side = line.split("=")[0]
            left_side = left_side.strip()
            try:
                if left_side[0] == "(" and left_side[-1] == ")":
                    left_side = left_side[1:-1]         # remove the ( and )
                    left_side = left_side.strip()
                elif left_side[0] == "[" and left_side[-1] == "]":
                    left_side = left_side[1:-1]         # remove the [ and ]
                    left_side = left_side.strip()
                elif left_side[0] == "{" and left_side[-1] == "}":
                    left_side = left_side[1:-1]         # remove the { and }
                    left_side = left_side.strip()
            except:
                pass
            left_side = left_side.strip()

            if contains_only_valid_token_characters(left_side):
                variable_names_to_rename.add(left_side)

            test2 = left_side.replace("[", "").replace("]", "").replace("(", "").replace(")", "").replace("{", "").replace("}", "").replace(".", "")
            if "," in test2:
                test = test2.replace(';', ',').replace(':', ',')
                for x in test.split(','):
                    x = x.strip()
                    variable_names_to_rename.add(x)
        else:
            pass

    # Now filter out some "bad" cases with incorrect variable names
    tmp = set()
    for variable_name in variable_names_to_rename:
        # print(variable_name)
        # TODO: write the next line better...
        variable_name = variable_name.replace("[", "").replace("]", "").replace("{", "").replace("}", "").replace("/", "").replace(":", "").replace('"', "").replace("'", "").replace("(", "").replace(")", "")
        if len(variable_name) == 0:
            continue    # just a safety check
        elif variable_name.startswith("var_"):
            continue
        if variable_name.startswith("func_"):
            continue
        elif variable_name == "arguments":
            continue
        elif variable_name == "yield":
            continue
        elif variable_name == "new.target":
            continue
        if " " in variable_name:
            variable_name = variable_name.split(" ")[0]

        variable_name = variable_name.strip()
        if variable_name.isdigit():
            continue
        tmp.add(variable_name)
    variable_names_to_rename = list(tmp)

    # Hack for fuzzilli corpus input:
    # Fuzzilli names all variables like "v123", so I can try if such variables
    # are in the testcase and then add variable names which I didn't detect correctly
    content_test = get_content_without_special_chars(content)
    for i in range(0, 2500):     # longest testcases had something like 1200 variables
        token_name = "v%d" % i
        token_name_with_space = token_name + " "
        if token_name_with_space in content_test:
            if token_name not in variable_names_to_rename:
                variable_names_to_rename.append(token_name)
    return variable_names_to_rename

def remove_shebang(content):
    if content.startswith("#!/") is False:
        return content
    new_content = content.split("\n", 1)[1]
    return content

def remove_comments(code_to_minimize):
    tmp = ""
    in_str_double_quote = False
    in_str_single_quote = False
    in_template_str = False
    previous_forward_slash = False
    previous_backward_slash = False
    in_multiline_comment = False
    previous_was_star = False
    for line in code_to_minimize.split("\n"):
        for current_char in line:
            if in_multiline_comment and not (current_char == "*" or current_char == "/"):
                previous_was_star = False
                continue    # ignore stuff inside multi-line comments
            if current_char == '"':
                if previous_backward_slash:
                    tmp += current_char
                    previous_forward_slash = False
                    previous_backward_slash = False
                    continue
                tmp += current_char
                in_str_double_quote = not in_str_double_quote
                previous_forward_slash = False
                previous_backward_slash = False
            elif current_char == "'":
                if previous_backward_slash:
                    tmp += current_char
                    previous_forward_slash = False
                    previous_backward_slash = False
                    continue
                tmp += current_char
                in_str_single_quote = not in_str_single_quote
                previous_forward_slash = False
                previous_backward_slash = False
            elif current_char == "`":
                if previous_backward_slash:
                    # `\`` === '`' // --> true
                    tmp += current_char
                    previous_forward_slash = False
                    previous_backward_slash = False
                    continue
                tmp += current_char
                in_template_str = not in_template_str
                previous_forward_slash = False
                previous_backward_slash = False
            elif current_char == "/":
                if previous_was_star:
                    # This means we were in a multi-line comment and it now terminated
                    previous_was_star = False
                    in_multiline_comment = False
                    previous_forward_slash = False
                    previous_backward_slash = False
                    continue    # ignore the current character and continue with next character normally
                previous_backward_slash = False
                if in_str_double_quote or in_str_single_quote or in_template_str:
                    # inside a string, so just add the character
                    tmp += current_char
                else:
                    if previous_forward_slash:
                        tmp = tmp[:-1]  # Remove the previous slash (which was the comment symbol)
                        break
                    else:
                        tmp += current_char
                        previous_forward_slash = True
            elif current_char == "\\":
                previous_backward_slash = not previous_backward_slash
                tmp += current_char
                previous_forward_slash = False
            elif current_char == "*":
                if in_multiline_comment:
                    previous_was_star = True
                    continue
                if previous_forward_slash:
                    # Start of a multi line comment
                    in_multiline_comment = True
                    tmp = tmp[:-1]
                else:
                    tmp += current_char
            else:
                tmp += current_char
                previous_forward_slash = False
                previous_backward_slash = False
        tmp = tmp.rstrip()
        tmp += "\n"

    minimized_code = tmp.rstrip()

    return minimized_code

def remove_semicolon_lines(code_to_minimize):
    # First attempt is to remove multiple occurrences of a semicolon after each other
    # E.g.:
    # ;;;1+2;;
    # Will become:
    # ;1+2;
    tmp = code_to_minimize
    while ";;" in tmp:
        tmp = tmp.replace(";;", ";")

    if tmp != code_to_minimize:
        code_to_minimize = tmp  # replacement worked


    # Now remove empty lines which just contain ";"
    # And also remove the trailing ";" from lines like:
    # ;1+2
    # =>
    # 1+2
    tmp = ""
    for line in code_to_minimize.split("\n"):
        if line.strip() == ";":
            continue    # skip these lines
        elif line.startswith(";"):
            tmp += line[1:] + "\n"      # remove the ";"
        else:
            tmp += line + "\n"

    if tmp != code_to_minimize:
        code_to_minimize = tmp

    return code_to_minimize

def add_possible_required_newlines(code_to_minimize):
    tmp = code_to_minimize.replace(";", ";\n").replace("\n\n", "\n")
    if tmp != code_to_minimize:
        code_to_minimize = tmp
    return code_to_minimize

def rename_variables(content):
    variable_names_to_rename = get_all_variable_names_in_testcase(content)

    # the above method (get_all_variable_names_in_testcase()) was my old code which missed a lot of cases
    # The following function is my new code which should catch all variable names!
    # Just to get sure I merge both lists (which most likely contains some wrong cases from the first function
    # but it doesn't matter, the runtime is just a little bit longer...)
    variable_names_to_rename2 = get_variable_name_candidates(content)
    for variable_name in variable_names_to_rename2:
        if variable_name not in variable_names_to_rename:
            variable_names_to_rename.append(variable_name)

    if len(variable_names_to_rename) == 0:
        return content      # Nothing to rename

    # Start renaming with the longest variable name.
    # This helps to prevent cases where a variable name is the substring of another variable name
    variable_names_to_rename.sort(reverse=True, key=len)

    # Get starting ID for the new variables
    last_used_variable_id = 0
    for idx in range(8000):
        token_name = "var_%d_" % idx
        if token_name in content:
            last_used_variable_id = idx

    # Now iterate through all variables and replace them
    variable_id = last_used_variable_id+1
    for variable_name in variable_names_to_rename:
        utils.msg("[i] Attempting to rename variable: %s" % variable_name)

        renamed_successful = False

        for i in range(0, 2):    # try 2 times to rename a variable => it's really important that the fuzzer knows the variable token names!
            new_content = js_renaming.rename_variable_name_safe(content, variable_name, variable_id)
            # print("attempt1_variable")
            if new_content != content:
                renamed_successful = True
                break

        if renamed_successful is False:
            if variable_name != "_":
                for i in range(0, 2):
                    # Here is a fallback to old code which renamed tokens (which is likely buggy but maybe works in some corner cases?)
                    new_content = js_renaming.rename_variable_name_old(content, variable_name, variable_id)
                    # print("attempt2_variable")
                    if new_content != content:
                        renamed_successful = True
                        break

        if renamed_successful is False:
            if variable_name != "_":
                # Last fallback is just to try replacing every token....
                new_content = content.replace(variable_name, "var_%d_" % variable_id)
                # print("attempt3_variable")
                if new_content != content:
                    renamed_successful = True

        if renamed_successful:
            utils.msg("[+] Successfully renamed variable: %s to var_%d_" % (variable_name, variable_id))
            content = new_content
            variable_id += 1
        else:
            utils.msg("[-] Renaming variable failed: %s" % variable_name)
    return content

def standardize_seed(seed):
    with open(seed, "r") as f:
        content = f.read()
    content = remove_shebang(content)
    content = remove_comments(content)
    content = remove_semicolon_lines(content)
    content = add_possible_required_newlines(content)
    content = rename_variables(content)
    #content = rename_functions(content)
    #content = rename_classes(content)
    #content = add_newlines(content)
    return content
print(standardize_seed(sys.argv[1]))
