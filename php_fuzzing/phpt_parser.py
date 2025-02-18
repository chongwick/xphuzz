import re
import codecs

class phpt_obj:
    def __init__(self):
        self.extensions = []
        self.ini = []
        self.code = ""

    def add_extensions(self,extension):
        if type(extension) == type([]):
            self.extensions += extension
        else:
            self.extensions.append(extension)

    def add_ini(self,ini):
        if type(ini) == type([]):
            self.ini += ini
        else:
            self.ini.append(ini)

    def add_file(self,code):
        self.code = code

    def compile_phpt(self):
        if len(self.extensions) != 0:
            content = """--TEST--
PHP TESTING
--EXTENSIONS--
{extensions}
--INI--
{ini}
--FILE--
{code}
--EXPECT--""".format(
                extensions="\n".join(self.extensions),
                ini="\n".join(self.ini),
                    code=self.code)
        else:
            content = """--TEST--
PHP TESTING
--INI--
{ini}
--FILE--
{code}
--EXPECT--""".format(
                ini="\n".join(self.ini),
                    code=self.code)
        return content

def parse_phpt(content, section):
        """
        Extract a specific section from the PHPT file, identified by the section header.
        Args:
            content: The full PHPT file content.
            section: The section to extract (e.g., --FILE--).

        Returns:
            The content of the specified section or an empty string if not found.
        """
        if section not in content:
            return ""
        start_idx = content.find(section) + len(section)
        x = re.search("--([_A-Z]+)--", content[start_idx:])
        end_idx = x.start() if x != None else len(content) - 1
        ret = content[start_idx:start_idx + end_idx].strip("\n")
        return ret

#def parse_phpt(content):
#    #with codecs.open(phpt_file,'r',encoding='utf-8',
#    #                 errors='ignore') as f:
#    #    content = f.readlines()
#    content = [i + "\n" for i in content.split("\n")]
#    is_extensions = False
#    is_ini = False
#    is_code = False
#    extensions = []
#    ini = []
#    code = []
#    for line in content:
#        if "EXTENSIONS" in line:
#            is_extensions = True
#            is_ini = False
#            is_code = False
#            continue
#        elif "INI" in line:
#            is_extensions = False
#            is_ini = True
#            is_code = False
#            continue
#        elif "FILE" in line:
#            is_extensions = False
#            is_ini = False
#            is_code = True
#            continue
#        elif "--\n" in line:
#            is_extensions = False
#            is_ini = False
#            is_code = False
#        if is_extensions:
#            extensions.append(line.split("\n")[0])
#        elif is_ini:
#            ini.append(line.split("\n")[0])
#        elif is_code:
#            code.append(line.split("\n")[0])
#    return (extensions,ini,"\n".join(code))
#
