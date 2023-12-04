class Prompter:
    def __init__(self):
        self.delimiter = "###"
        self.inject_statement_prompt = ("Write {n}+ new statements that could be inserted " +
                                        "at {d}".format(d=self.delimiter))
        self.inject_variable_prompt = ("Initialize {n}+ new variables or objects " +
                "that could be inserted at {d}".format(d=self.delimiter))
        self.extension_prompt = "Add to this"

    #Primitive operations
    def inject_statement(self, snippet, num, loc, generic=True):
        if generic:
            lines = [i+"\n" for i in snippet.split("\n")]
            lines.insert(loc+1,"###\n") # Line after the structure is defined
            prompt = "".join(lines) + "\n" + self.inject_statement_prompt.format(n=num)
            print("prompt:\n" + prompt + "\n")
            return(prompt, "".join(lines))

    def inject_variable(self, snippet, num, loc, generic=True):
        if generic:
            lines = [i+"\n" for i in snippet.split("\n")]
            lines.insert(loc+1,"###\n") # Line after the structure is defined
            prompt = "".join(lines) + "\n" + self.inject_variable_prompt.format(n=num)
            print("prompt:\n" + prompt + "\n")
            return(prompt, "".join(lines))

    #Nondeterministic operations
    def fix(self, error):
        out_str = error
        return(out_str)

    def extend(self, snippet):
        prompt = snippet + "\n" + self.extension_prompt
        return(prompt)

    def complicate(self, snippet):
        out_str = "Make this more complicated:\n" + snippet
        return(out_str)

    def combine(self, snippet_list):
        segments = ""
        for snip in snippet_list:
            with open(snip, "r") as f:
                segments += f.read()
            segments += "\n\n"
        prompt = segments + "\n Intermingle these pieces of code"
        return(prompt)

