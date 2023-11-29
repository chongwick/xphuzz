class Formatter():
    def __init__(self):
        self.i = 0

    def label_lines(self, in_file):
        output = ""
        with open(in_file, "r") as f:
            content = f.readlines()
        for count, line in enumerate(content):
            output += str(count) + ": " + line
        return output

