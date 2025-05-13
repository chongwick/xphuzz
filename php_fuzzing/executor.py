# This will run the executable and read from the shared memory :)

import config as cfg
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

class Executor():
    def __init__(self, engine):
        self.prog_argv = []
        self.engine = engine
        self.prog_argv.append(engine)
        self.smm = SharedMemoryManager()
        self.smm.start()  # Start the process that manages the shared memory blocks
        self.raw_shm = self.smm.SharedMemory(size=MEM_SIZE)
        os.environ["SHM_ID"] = self.raw_shm.name
        with open("blank.js", "w") as f:
            f.write("\n")
        self.execute_prog("blank.js")
        self.ret_code = None
        os.remove("blank.js")
        
    def __del__(self):
        self.smm.shutdown(self)

    def execute_prog(self, script, instructions="--allow-natives-syntax"):
        command = self.prog_argv.copy()
        if instructions != None and instructions != "":
            command.append(instructions)
        command.append(script)
        try:
            child = subprocess.Popen(command, 
                                     stdout=subprocess.PIPE, 
                                     stderr=subprocess.PIPE,
                                     text=True)
            stdout, stderr = child.communicate(timeout=40) #timeout after 40 seconds
            self.ret_code = child.returncode
            child.kill()
        except Exception as e:
            return -1
        result = None
        result = (self.ret_code, stdout, stderr)
        return result
        #if self.engine == cfg.coverage_engine:
        #    result = "\n".join(stdout.split("\n")[2:])
        #else:
        #    result = ""
        #    for i in stdout:
        #        result += i
        #return result

    def adjust_coverage_with_dummy_executions(self):
        with open("blank.js", "w") as f:
            f.write("\n")
        self.execute_prog("blank.js")

    def save_global_coverage_map_in_file(self, file_name):
        with open(file_name,'wb') as f:
            f.write(self.raw_shm.buf[:])

    def load_global_coverage_map_from_file(self, file_name):
        with open(file_name,'rb') as f:
            data = f.read()
        self.raw_shm.buf[:] = data[:]

    #def get_new_coverage():
    #    cov_eng.load_global_coverage_map_from_file(cfg.collective_map)
    #    cur_cov = cov_eng.read()
    #    cov_eng.execute_prog(php_file)
    #    increase = cov_eng.read() - cur_cov
    #    cov_eng.save_global_coverage_map_in_file(cfg.collective_map)

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
    executor = Executor(cfg.coverage_engine)
    executor.make_base_map("base_map_php_4_20_24")

if __name__ == "__main__":
    main()
