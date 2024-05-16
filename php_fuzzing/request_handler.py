import os
import receiver
import config as cfg
import pickle

fix_prompt = "The response did not correspond to the ```<code>``` format."

def correct_format(llm, result, context):
    result = [line + "\n" for line in result.split("\n")]
    #if result[0].strip() == "error":
    #    raise RuntimeError("Restarting LLM")
    i = 0
    code = ""
    while i < 2:
        i += 1
        code_section = False
        for line in result:
            if "```" in line and not(code_section):
                code_section = True
            elif "```" in line and code_section:
                break
            elif code_section:
                code += line
        if code == "":
            print("\n! Re-query: Format Error !\n")
            context.append({'role': 'user', 'content': fix_prompt})
            result = llm.give_context(context)
        else:
            break
    try:
        if "<?php" not in code.split("\n")[0]:
            code = "<?php\n" + code + "\n?>"
    except Exception as e:
        print("ERRRORRRRRR")
        print(code)
        quit()
    return code

def main():
    role = 'You are a chatting assistant'
    context = [{'role': 'system', 'content': role}]
    llm = receiver.LLAMA3_LLM(context)

    while(True):
        #We protect this action because we are changing the queue
        cfg.enter_shared_dir(cfg.llm_requests)
        with open(cfg.llm_queue, "rb") as f:
            request_queue = pickle.load(f)
        with open(cfg.llm_queue, "wb") as f:
            pickle.dump([], f, protocol=pickle.HIGHEST_PROTOCOL) #we have all the requests loaded
        cfg.exit_shared_dir(cfg.llm_requests)

        while(len(request_queue) != 0):
            request_file = request_queue.pop(0)
            output_file = os.path.join(cfg.cov_requests,
                    request_file.split("/")[-1].split("_")[0]+".php")

            #update progress
            with open(cfg.llm_progress, "wb") as f:
                pickle.dump(request_queue, f, protocol=pickle.HIGHEST_PROTOCOL)

            with open(request_file, "rb") as f:
                pickle_content = pickle.load(f)
            os.remove(request_file)
            fix_number = pickle_content[0]
            context = pickle_content[1]

            result = llm.give_context(context)
            context.append({'role':'assistant','content':result})
            code = correct_format(llm, result, context)
            #print(code)
            cfg.enter_shared_dir(cfg.cov_requests)
            with open(output_file,"w") as f:
                f.write(code)
            with open(cfg.cov_queue, "rb") as f:
                queue = pickle.load(f)
            queue.append(output_file)
            with open(cfg.cov_queue, "wb") as f:
                pickle.dump(queue, f, protocol=pickle.HIGHEST_PROTOCOL)
            cfg.exit_shared_dir(cfg.cov_requests)


if __name__ == "__main__":
    main()
