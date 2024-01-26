import random

class Prompter:
    def __init__(self):
        self.delimiter = "###"
        self.formatter = "Format as ```<code>```"
        self.base_generation = ""
        self.inject_statement_prompt = ("Write {n}+ new statements to be inserted " +
                                        "at {d}. Do not throw errors or print. {f}".format(d=self.delimiter,f=self.formatter))
        #self.inject_statement_prompt = ("Write {n}+ new statements to be inserted " +
        #                                "at {d} manipulating the local variables. {f}".format(d=self.delimiter,f=self.formatter))
        self.inject_variable_prompt = ("Initialize {n}+ new variables or objects " +
                "to be inserted at {d}. {f}".format(d=self.delimiter,f=self.formatter))
        self.replace_statement_prompt = (
                "Change only the line marked by {d}.".format(d=self.delimiter))
        self.extension_prompt = "Add to this"

    #Primitive operations
    def inject_statement(self, snippet, num, loc, s_type, generic=True):
        if generic:
            lines = [i+"\n" for i in snippet.split("\n")]
            lines.insert(loc+1,self.delimiter+"\n") # Line after the structure is defined
            prompt = "".join(lines) + "\n" + self.inject_statement_prompt.format(n=num)
            print("prompt:\n" + prompt + "\n")
            return(prompt, "".join(lines))

    def inject_variable(self, snippet, num, loc, s_type, generic=True):
        if generic:
            lines = [i+"\n" for i in snippet.split("\n")]
            lines.insert(loc+1,self.delimiter+"\n") # Line after the structure is defined
            prompt = "".join(lines) + "\n" + self.inject_variable_prompt.format(n=num)
            print("prompt:\n" + prompt + "\n")
            return(prompt, "".join(lines))

    def replace_statement(self, snippet, num, loc, s_type, generic=True):
        if generic:
            if s_type == "structure_ends":
                return(self.inject_statement(snippet,num,loc,s_type)) # Can't change "}"
            lines = [i+"\n" for i in snippet.split("\n")]
            lines[loc] = self.delimiter+lines[loc]
            prompt = "".join(lines) + "\n" + self.replace_statement_prompt.format(n=num)
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

    def mix(self, base, ancilla):
        prompt = "Here is Code A:\n```"
        prompt += base + "\n```"
        prompt += "Here is Code B:\n```"
        prompt += ancilla + "\n```"
        #prompt += "Stochastically mix these pieces of code together"
        #prompt += "Mix these pieces of code together"
        prompt += "Use Code B in Code A. Do not simply append B to A." + self.formatter
        return(prompt)

### NEW STUFF ###
    def insert_delimiter(snippet, loc):
        if loc != None:
            lines = [i+"\n" for i in snippet.split("\n")]
            lines.insert(loc+1,self.delimiter+"\n") # Line after the structure is defined
            delimited_snippet = "".join(lines)
            return delimited_snippet
        else: # Insert into random location
            lines = [i+"\n" for i in snippet.split("\n")]
            lines.insert(random.randint(0,len(lines)),self.delimiter+"\n")
            delimited_snippet = "".join(lines)
            return delimited_snippet

    # Adds a random variable to the snippet -> We want to be mindful of the context of the snippet
    # i.e. what the snippet contains s.t. the LLM has sufficient context to insert a sensible variable
    def add_variable(self, snippet, loc=None):
        ...


