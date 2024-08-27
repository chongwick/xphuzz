# This will run the executable and read from the shared memory :)

import numpy
import array
import sys
import os
import enum
import subprocess
import pexpect
from multiprocessing.managers import SharedMemoryManager
from multiprocessing import shared_memory

MEM_SIZE = 0x100000
#ENGINE_PATH = "/home/w023dtc/php_fuzzing/cov_php"  
COVERAGE_ENGINE = "/home/w023dtc/php_fuzzing/cov_php"
SANITIZER_ENGINE = "/home/w023dtc/php_fuzzing/san_php"
RELASE_ENGINE = "/home/w023dtc/php_fuzzing/rel_php"

class Executor():
    def __init__(self, engine):
        self.prog_argv = []
        self.engine = engine
        self.prog_argv.append(engine)
        self.smm = SharedMemoryManager()
        self.smm.start()  # Start the process that manages the shared memory blocks
        self.raw_shm = self.smm.SharedMemory(size=MEM_SIZE)
        os.environ["SHM_ID"] = self.raw_shm.name
        with open("blank.php", "w") as f:
            f.write("<?php\n?>")
        self.execute_prog("blank.php")
        self.ret_code = None
        os.remove("blank.php")
        
    def __del__(self):
        self.smm.shutdown(self)

    def execute_prog(self, script):
        command = self.prog_argv.copy()
        command.append(script)
        try:
            #child = subprocess.Popen(command, stdout=subprocess.PIPE, text=True)
            #stdout, stderr = child.communicate(timeout=40) #timeout after 40 seconds
            child = subprocess.run(command, text=True, timeout=120, capture_output=True)
            stdout = child.stdout
            self.ret_code = child.returncode
            child.kill()
        except Exception as e:
            return -1
        if self.ret_code == 1:
            return 'seg'
        result = None
        if self.engine == COVERAGE_ENGINE:
            result = "\n".join(stdout.split("\n")[2:])
        else:
            result = ""
            for i in stdout:
                result += i
        return result

    # We want the same session open when we're creating the base map
    # Thus, child... pexpect...
    def adjust_coverage_with_dummy_executions(self):
        child = pexpect.spawnu(self.engine, ['-a'])
        child.expect('php >') 
        cmd_input = "<?php\n?>"
        for i in range(150):
            child.write(cmd_input)

    def save_global_coverage_map_in_file(self, file_name):
        with open(file_name,'wb') as f:
            f.write(self.raw_shm.buf[:])

    def load_global_coverage_map_from_file(self, file_name):
        with open(file_name,'rb') as f:
            data = f.read()
        self.raw_shm.buf[:] = data[:]

    def read(self):
        edge_count = 0
        arr = array.array('B', self.raw_shm.buf[:])
        for i in arr:
            if i != 0:
                edge_count += i.bit_count()
        return edge_count

        #bm = numpy.frombuffer(arr).nonzero()
        #print(bm)

    def make_base_map(self, filename):
        self.adjust_coverage_with_dummy_executions()
        self.save_global_coverage_map_in_file(filename)

def main():
    executor = Executor(COVERAGE_ENGINE)
    executor.make_base_map("base_map_php_4_20_24")

if __name__ == "__main__":
    main()
