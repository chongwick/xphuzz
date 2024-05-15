import os
import config as cfg
import pickle
from executor import Executor
import errreader as err

class Fixer():
    def generate_fix_prompt(self, code, error):
        role = 'Fix PHP code. Return as ```<code>```'
        context = [{'role': 'system', 'content': role}]
        prompt = ""
        prompt += "```\n{c}\n```\n".format(c=code)
        prompt += error
        context.append({'role': 'user', 'content': prompt})
        return context

def main():
    cov_eng = Executor(cfg.coverage_engine)
    fixer = Fixer()

    while(True):
        #We protect this action because we are changing the queue
        cfg.enter_shared_dir(cfg.cov_requests)
        with open(cfg.cov_queue, "rb") as f:
            request_queue = pickle.load(f)
        with open(cfg.cov_queue, "wb") as f:
            pickle.dump([], f, protocol=pickle.HIGHEST_PROTOCOL) #we have all the requests loaded
        cfg.exit_shared_dir(cfg.cov_requests)

        while(len(request_queue) != 0):
            request_file = request_queue.pop(0)
            output_file = os.path.join(cfg.san_queue,request_file)
            with open(request_file, "r") as f:
                code = f.read()
            result = cov_eng.execute_prog(request_file)
            if result == -1:
                print("Bad execution")
                continue
            if err.is_error(result):
                context = fixer.generate_fix_prompt(code, err.parse_error(result, request_file))
            else:
                cfg.enter_shared_dir(cfg.san_requests)
                os.rename(request_file, output_file)
                with open(cfg.san_queue, "rb") as f:
                    san_queue = pickle.load(f)
                san_queue.append(output_file)
                with open(cfg.san_queue, "wb") as f:
                    pickle.dump(san_queue,f,protocol=pickle.HIGHEST_PROTOCOL)
                cfg.exit_shared_dir(cfg.san_requests)

                


if __name__ == "__main__":
    main()
