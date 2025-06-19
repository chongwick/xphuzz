import os
import config as cfg
import utils
import subprocess

curr_dir=os.path.dirname(os.path.realpath(__file__))
engine_commands = [
        ['bash','./jerry.sh'],
        ]

js_file = utils.pop_from_queue(cfg.other_sans)
js_file = "gen_1/2978137d11db05822cc6"
for command in engine_commands:
    tmp_command = command.copy()
    tmp_command.append(js_file)
    try:
        child = subprocess.Popen(tmp_command,
                stdout=subprocess.PIPE,
                stderr=subprocess.PIPE,
                text=True)
        stdout,stderr = child.communicate(timeout=40)
        ret_code = child.returncode
    except Exception as e:
        print(e)
        continue
    if "./jerry.sh" in command:
        stderr = stderr.replace("/home/w023dtc/jerryscript/jerryscript/jerry-core/parser/js/js-scanner-util.c:2345:39: runtime error: applying zero offset to null pointer\nSUMMARY: UndefinedBehaviorSanitizer: undefined-behavior /home/w023dtc/jerryscript/jerryscript/jerry-core/parser/js/js-scanner-util.c:2345:39 in","")
        if "Sanitizer" in stderr or "sanitizer" in stderr:
            os.rename(js_file,js_file+".jer_er")
            js_file = js_file + ".jer_er"
    elif "./quickjs.sh" in command:
        ...
