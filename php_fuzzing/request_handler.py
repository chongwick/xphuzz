import os
import receiver
import config as cfg
import utils
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

def get_seed_data():
    utils.enter_seed_database()
    with open(cfg.seed_data, "rb") as f:
        seed_data = pickle.load(f)
    utils.exit_seed_database()
    return seed_data

def update_seed_data(seed_data):
    utils.enter_seed_database()
    with open(cfg.seed_data, "wb") as f:
        pickle.dump(seed_data,f,protocol=pickle.HIGHEST_PROTOCOL)
    utils.exit_seed_database()

def main():
    role = 'You are a chatting assistant'
    context = [{'role': 'system', 'content': role}]
    llm = receiver.LLAMA3_LLM(context)

    while(True):
        #We protect this action because we are changing the queue
        utils.enter_shared_dir(cfg.llm_requests)
        with open(cfg.llm_queue, "rb") as f:
            request_queue = pickle.load(f)
        if len(request_queue) == 0:
            continue
        request_file = request_queue.pop(0)
        seed_name = request_file.split("/")[-1].split("_")[0]
        with open(cfg.llm_queue, "wb") as f:
            pickle.dump(request_queue, f, protocol=pickle.HIGHEST_PROTOCOL)
        utils.exit_shared_dir(cfg.llm_requests)
        
        php_file = os.path.join(cfg.php_corpus,
                request_file.split("/")[-1].split("_")[0]+".php")

        seed_data = get_seed_data()
        if seed_name not in seed_data:
            seed_data[seed_name] = {"fix_count":0,"php_file":php_file,"context":None}


        if("_t" in request_file): #Translation request

            ##update progress
            #with open(cfg.llm_progress, "wb") as f:
            #    pickle.dump(request_queue, f, protocol=pickle.HIGHEST_PROTOCOL)

            with open(request_file, "rb") as f:
                context = pickle.load(f)
            os.remove(request_file)

            result = llm.give_context(context)
            context.append({'role':'assistant','content':result})
            code = correct_format(llm, result, context)
            #print(code)
            utils.enter_shared_dir(cfg.php_corpus)
            with open(php_file,"w") as f:
                f.write(code)
            utils.exit_shared_dir(cfg.php_corpus)
            utils.add_to_queue(cfg.cov_queue,php_file)


        elif("_f" in request_file): #Fix request
            quit()
            ...

        update_seed_data(seed_data)


if __name__ == "__main__":
    main()
