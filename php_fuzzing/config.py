llama3_max = 8000
query_time_limit = 20
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
leaks = "leaks.pickle"
php_corpus = "php_corpus"
php_template = "grammar_generators/template.php"

llm_queue = "llm_requests/queue.pickle"
cov_queue = "queues/cov_queue.pickle"
san_queue = "queues/san_queue.pickle"

llm_lock = "llm_requests/queue.pickle.lock"
cov_lock = "queues/cov_queue.pickle.lock"
san_lock = "queues/san_queue.pickle.lock"
mutation_directory = "mut_dir"

og_crashers = ['d2813ca45f985468082c.php.er','9bbb3d12c72ec05bae77.php.er','6160c4993faa77f32567.php.er','ed888f31e82a1d1513ab.php.er','2aefc0f640cc7b774e6c.php.er','83f4d4cfa6af8963ad0e.php.er','e6ace91d50acd2431c69.php.er','e43a743e59cf8610dcb5.php.er','60acd5dbdc5c2250b7f6.php.er','8332a207a3b934a83ada.php.er','6cbd0de04bef1ebc3858.php.er']

afl_tag = 'file_get_contents("php://stdin")'
