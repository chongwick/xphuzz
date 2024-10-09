#   Domato - main generator script
#   -------------------------------
#
#   Written and maintained by Ivan Fratric <ifratric@google.com>
#
#   Copyright 2017 Google Inc. All Rights Reserved.
#   Licensed under the Apache License, Version 2.0 (the "License");
#   you may not use this file except in compliance with the License.
#   You may obtain a copy of the License at
#
#       http://www.apache.org/licenses/LICENSE-2.0
#
#   Unless required by applicable law or agreed to in writing, software
#   distributed under the License is distributed on an "AS IS" BASIS,
#   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
#   See the License for the specific language governing permissions and
#   limitations under the License.


from __future__ import print_function
import os
import re
import random
import sys
import uuid

parent_dir = os.path.abspath(os.path.join(os.path.dirname(__file__), os.pardir))
sys.path.append(parent_dir)
from grammar import Grammar

_N_MAIN_LINES = 100
_N_EVENTHANDLER_LINES = 1

def generate_function_body(jsgrammar, num_lines):
    js = ''
    js += jsgrammar._generate_code(num_lines)

    return js

def GenerateNewSample(template, jsgrammar, n_lines):
    """Parses grammar rules from string.

    Args:
      template: A template string.
      htmlgrammar: Grammar for generating HTML code.
      cssgrammar: Grammar for generating CSS code.
      jsgrammar: Grammar for generating JS code.

    Returns:
      A string containing sample data.
    """

    result = template
    handlers = False
    while '<phpfuzz>' in result:
        numlines = n_lines
        if handlers:
            numlines = _N_EVENTHANDLER_LINES
        else:
            handlers = True
        result = result.replace(
            '<phpfuzz>',
            generate_function_body(jsgrammar, numlines),
            1
        )

    return result


def generate_samples(grammar_dir, outfile, template, n_lines, lineguard="php.txt"):
    """Generates a set of samples and writes them to the output files.

    Args:
      grammar_dir: directory to load grammar files from.
      outfiles: A list of output filenames.
    """

    #f = open(os.path.join(grammar_dir, 'template.php'))
    #template = f.read()
    #f.close()

    jsgrammar = Grammar()
    err = jsgrammar.parse_from_file(os.path.join(grammar_dir, lineguard))
    if err > 0:
        print('There were errors parsing grammar')
        return

    result = GenerateNewSample(template, jsgrammar, n_lines)
    if outfile == None:
        return result
    #print(result)

    if result is not None:
        #print('Writing a sample to ' + outfile)
        try:
            f = open(outfile, 'w')
            f.write(result)
            f.close()
        except IOError:
            print('Error writing to output')

