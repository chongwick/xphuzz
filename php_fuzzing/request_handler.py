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

def main():
    role = 'You are a chatting assistant'
    context = [{'role': 'system', 'content': role}]
    llm = receiver.LLAMA3_LLM(context)

    while(True):
        #We protect this action because we are changing the queue

        request_file = utils.pop_from_queue(cfg.llm_queue)
        seed_name = request_file.split("/")[-1].split("_")[0]
        #request_queue = utils.load_pickle(cfg.llm_queue)
        #if len(request_queue) == 0:
        #    continue
        #request_file = request_queue.pop(0)
        #seed_name = request_file.split("/")[-1].split("_")[0]
        #utils.dump_pickle(cfg.llm_queue, request_queue)

        php_file = os.path.join(cfg.php_corpus,
                request_file.split("/")[-1].split("_")[0]+".php")
        
        seed_data = utils.load_pickle(cfg.seed_data)

        if seed_name not in seed_data:
            seed_data[seed_name] = {
                    "reset_count": 0,
                    "fix_count": 0,
                    "php_file": php_file,
                    "context": None,
                    "context_length": 0,
                    "relative_coverage": 0 #coverage is relative to the base map
                    }

        #The initial seed translation prompt does not matter for context history
        if("_t" in request_file): 
            print("Translating: {}".format(request_file))
            ##update progress
            #with open(cfg.llm_progress, "wb") as f:
            #    pickle.dump(request_queue, f, protocol=pickle.HIGHEST_PROTOCOL)

            context = utils.load_pickle(request_file)
            os.remove(request_file)

            result = llm.give_context(context)
            context.append({'role':'assistant','content':result})
            code = correct_format(llm, result, context)
            #print(code)
            utils.write_file(php_file, code)

            utils.add_to_queue(cfg.cov_queue, php_file)
            #cov_queue = utils.load_pickle(cfg.cov_queue)
            #cov_queue.append(php_file)
            #utils.dump_pickle(cfg.cov_queue, cov_queue)


        elif("_f" in request_file): #Fix request
            print("Fixing: {}".format(request_file))
            history = seed_data[seed_name]
            if history['fix_count'] == 5:
                print("Nah, can't fix this one")
            else:
                context = utils.load_pickle(request_file)
                if history['fix_count'] == 0:
                    history['context'] = context
                else:
                    history['context'].append(context[-1])
                    context = history['context'] #Perhaps we just want to give it the present context
                history['fix_count'] += 1
                os.remove(request_file)
                result = llm.give_context(context)
                context.append({'role':'assistant','content':result})
                code = correct_format(llm, result, context)
                utils.write_file(php_file, code)
                utils.add_to_queue(cfg.cov_queue, php_file)

        utils.dump_pickle(cfg.seed_data, seed_data)


if __name__ == "__main__":
    main()
