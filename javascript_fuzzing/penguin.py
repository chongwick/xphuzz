class Prompter:
    def __init__(self):
        self.i = 0
    #Five primitive operations
    def combine(self, snippet_list, context):
        segments = ""
        for snip in snippet_list:
            with open(snip, "r") as f:
                segments += f.read()
            segments += "\n\n"
        out_str = segments + "\n Intermingle these pieces of code"
        return(out_str)

    def complicate(self, snippet, context):
        out_str = "Make this more complicated:\n" + snippet
        return(out_str)

    def inject(self, snippet, context):
        out_str = "use more JavaScript functions:\n" + snippet
        return(out_str)

    def fix(self, error, context):
        out_str = error
        return(out_str)

    def extend(self, snippet, context):
        out_str = "Add to this:\n" + snippet
        return(out_str)
