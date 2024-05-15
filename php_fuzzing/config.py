import os
token_max = 4097*2
coverage_engine = "/home/w023dtc/php_engines/cov_php"
sanitizer_engine = "/home/w023dtc/php_engines/san_php"
release_engine = "/home/w023dtc/php_engines/rel_php"
model_id = "meta-llama/Meta-Llama-3-8B-Instruct"
llm_requests = "llm_requests"
llm_queue = "llm_requests/queue.pickle"
cov_requests = "coverage_requests"
cov_queue = "coverage_requests/queue.pickle"
san_requests = "sanitization_requests"
san_queue = "sanitization_requests/queue.pickle"

llm_progress = "llm_progress.pickle"

def enter_shared_dir(directory):
    vacant_file=os.path.join(directory,"vacant")
    occupied_file=os.path.join(directory,"occupied")
    is_vacant = lambda : os.path.isfile(vacant_file)
    while not is_vacant():
        pass
    os.rename(vacant_file, occupied_file)

def exit_shared_dir(directory):
    vacant_file=os.path.join(directory,"vacant")
    occupied_file=os.path.join(directory,"occupied")
    os.rename(occupied_file, vacant_file)


