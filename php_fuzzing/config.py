token_max = 4097*2
coverage_engine = "/home/w023dtc/php_engines/cov_php"
sanitizer_engine = "/home/w023dtc/php_engines/san_php"
release_engine = "/home/w023dtc/php_engines/rel_php"
model_id = "meta-llama/Meta-Llama-3-8B-Instruct"
llm_requests = "llm_requests"
seed_data = "seed_data.pickle"
php_corpus = "php_corpus"

llm_queue = "llm_requests/queue.pickle"
cov_queue = "queues/cov_queue.pickle"
san_queue = "queues/san_queue.pickle"

llm_busy = "llm_requests/llm_busy"
cov_busy = "queues/cov_busy"
san_busy = "queues/san_busy"

status_file = {
        llm_queue : llm_busy
        cov_queue : cov_busy
        san_queue : san_busy
        }
