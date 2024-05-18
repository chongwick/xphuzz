import config as cfg
import utils
import sys
import os
import fcntl

def generate_translation_prompt(content):
    role = 'Translate JavaScript to PHP. Return as ```<code>```'
    context = [{'role': 'system', 'content': role}]
    context.append({'role': 'user', 'content': content})
    return context

def main():
    requests = []
    input_directory = sys.argv[1].split("/")[0]
    seed_files = [os.path.join(input_directory,x) for x in os.listdir(input_directory)]

    #First, we want to queue up all the translation queries
    while len(seed_files) != 0:
        seed = seed_files.pop()
        query_context = generate_translation_prompt(utils.read_file(seed))
        output_file_name = seed.split("/")[-1].split(".")[0]+"_t"
        translation_req_name = os.path.join(cfg.llm_requests,output_file_name)
        utils.dump_pickle(translation_req_name, query_context)
        requests.append(translation_req_name)
        utils.dump_pickle(cfg.llm_queue, requests)





    # Main Execution Loop: clean bc it's confusing
    '''
    while len(translator.seed_files) != 0:
        seed = translator.pop_seed()

        with open(progress_file, "wb") as f:
            pickle.dump(translator.seed_files, f, protocol=pickle.HIGHEST_PROTOCOL)

        print("SEED: ", seed)
        seed_content = translator.get_content(seed)
        code = translator.query_translate(seed_content)
        if code == None:
            print("code none 1")
            continue
        output_file = os.path.join(output_directory,seed+".php")
        #cfg.write_file(output_file, code)
        with open(output_file, "w") as f:
            f.write(code)
        print("Executing")
        result = cov_eng.execute_prog(output_file)
        if result == -1:
            print("Bad execution")
            continue
        i = 0
        while err.is_error(result):
            i += 1
            code = fixer.query_fix(code, err.parse_error(result, output_file))
            if code == None:
                print("code none 2")
                break;
            #cfg.write_file(output_file, code)
            with open(output_file, "w") as f:
                f.write(code)
            result = cov_eng.execute_prog(output_file)
            if result == -1:
                print("Bad execution 2")
                break;
            if i == 5:
                print("didn't work")
                os.remove(output_file)
                break;

        print("COVERAGE", cov_eng.read(), " Fixes: ", i)
        '''

    #for seed in os.listdir(output_directory):
    #    print(san_eng.execute_prog(os.path.join(output_directory,seed)))
    

if __name__ == "__main__":
    main()
