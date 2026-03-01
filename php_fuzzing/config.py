llama3_max = 8000
query_time_limit = 20
token_max = 4097*2
base_map = "base_map_php_4_20_24"
collective_map = "collective_map"
base_map_edges = 3737
#coverage_engine = "/home/w023dtc/php_engines/cov_php"
#sanitizer_engine = "/home/w023dtc/php_engines/san_php"
#release_engine = "/home/w023dtc/php_engines/rel_php"
#undefined_engine = "/home/w023dtc/php_engines/undefined_php"
coverage_engine = "php_engines/cov_php"
sanitizer_engine = "php_engines/san_php"
undefined_engine = "php_engines/undefined_php"
ini = "/php_engines/php.ini"
model_id = "meta-llama/Meta-Llama-3-8B-Instruct"
llm_requests = "llm_requests"
seed_data = "seed_data.pickle"
stats = "stats.pickle"
php_corpus = "php_corpus"
php_template = "grammar_generators/template.php"
#require_statement = "require \"/home/w023dtc/template.inc\";"
require_statement = "require \"template.inc\";"
san_log = "san.log"
bug_log = "bug_log.pickle"
require_files = ['template.inc','filter_errors.inc']
safe_files = "safe_files.pickle"
phptests = 'phptests.pickle' #set up as a tuple of lists.
                             #pop from one, add it to the other
                             #to get good coverage of all.
inidir = "inis"
includes = '../incs/'
file_instr = 'file_instr.pickle'
hour_prompts = "hour_prompts.pickle"

llm_queue = "llm_requests/queue.pickle"
cov_queue = "queues/cov_queue.pickle"
san_queue = "queues/san_queue.pickle"
exec_queue = "queues/exec_queue.pickle"
status = {"queues/exec_queue.pickle":"queues/exec_queue.pickle.lock", 
          "llm_requests/queue.pickle":"llm_requests/queue.pickle.lock",
          "seed_data.pickle":"seed_data.pickle.lock",
          "file_instr.pickle":"file_instr.pickle.lock",
          "phptests.pickle":"phptests.pickle.lock",
          "time_file.txt":"time_file.txt.lock",
          "hour_prompts.pickle":"hour_prompts.pickle.lock",
          }
time_file = "time_file.txt"

llm_lock = "llm_requests/queue.pickle.lock"
cov_lock = "queues/cov_queue.pickle.lock"
san_lock = "queues/san_queue.pickle.lock"
mutation_directory = "mut_dir"

og_crashers = ['d2813ca45f985468082c.php.er','9bbb3d12c72ec05bae77.php.er','6160c4993faa77f32567.php.er','ed888f31e82a1d1513ab.php.er','2aefc0f640cc7b774e6c.php.er','83f4d4cfa6af8963ad0e.php.er','e6ace91d50acd2431c69.php.er','e43a743e59cf8610dcb5.php.er','60acd5dbdc5c2250b7f6.php.er','8332a207a3b934a83ada.php.er','6cbd0de04bef1ebc3858.php.er']

afl_tag = 'file_get_contents("php://stdin")'
