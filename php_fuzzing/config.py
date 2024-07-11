llama3_max = 1048576
token_max = 4097*2
base_map = "base_map_php_4_20_24"
collective_map = "collective_map"
base_map_edges = 3737
coverage_engine = "/home/w023dtc/php_engines/cov_php"
sanitizer_engine = "/home/w023dtc/php_engines/san_php"
release_engine = "/home/w023dtc/php_engines/rel_php"
model_id = "meta-llama/Meta-Llama-3-8B-Instruct"
llm_requests = "llm_requests"
seed_data = "seed_data.pickle"
stats = "stats.pickle"
php_corpus = "php_corpus"
php_template = "grammar_generators/template.php"

llm_queue = "llm_requests/queue.pickle"
cov_queue = "queues/cov_queue.pickle"
san_queue = "queues/san_queue.pickle"

llm_lock = "llm_requests/queue.pickle.lock"
cov_lock = "queues/cov_queue.pickle.lock"
san_lock = "queues/san_queue.pickle.lock"
mutation_directory = "mut_dir"

status = {
        llm_queue : llm_lock,
        cov_queue : cov_lock,
        san_queue : san_lock,
        }
