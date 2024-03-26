import sys
import pickle
import os
import native_code.executor as executor
import config as cfg

# Establish a base map to counteract nondeterministic behavior
# Eliminates the need to run dummy executions at every start
def initialize_base(exec_engine, output_name):
    exec_engine.adjust_coverage_with_dummy_executions()
    exec_engine.save_global_coverage_map_in_file(output_name)

def map_seed_bitmap(corpus_directory, exec_engine, base_map):
    exec_engine.load_global_coverage_map_from_file(base_map)   
    exec_engine.backup_global_coverage_map()  

    triggered, total = exec_engine.get_number_triggered_edges()
    #print("initial: triggered: {} total: {}".format(triggered, total))

    bitmap_directory = corpus_directory + "_bms"
    os.mkdir(bitmap_directory)

    seed_cov_map = {}

    output_str = ""
    
    # Record an initial coverage bitmap for each snippet and store it in an output file
    for file in os.listdir(corpus_directory):
        ### Don't remap already mapped files
        bitmap_file_C0V = bitmap_directory + "/" + file.split(".")[0]+"__0bm"
        bitmap_file_SUC = bitmap_directory + "/" + file.split(".")[0]+"__bm"
        if os.path.isfile(bitmap_file_C0V) or os.path.isfile(bitmap_file_SUC):
            pass
        ###
        with open(os.path.join(corpus_directory, file), 'r') as f:
            seed = f.read()
        exec_engine.restore_global_coverage_map()
        #exec_engine.load_global_coverage_map_from_file("backup")
        error_parser.clear_error_file()
        result = exec_engine.execute_safe(seed)
        error_message = error_parser.parse_error(cfg.error_file)
        if not(error_message):
            bitmap_file = bitmap_directory + "/" + file.split(".")[0]+"__bm"
        else:
            bitmap_file = bitmap_directory + "/" + file.split(".")[0]+"__0bm"
            
        #if result.num_new_edges == 0:
        #    bitmap_file = bitmap_directory + "/" + file.split(".")[0]+"__0bm"
        #else:
        #    bitmap_file = bitmap_directory + "/" + file.split(".")[0]+"__bm"

        seed_cov_map[str(file)]=bitmap_file
        exec_engine.save_global_coverage_map_in_file(bitmap_file)
        triggered, total = exec_engine.get_number_triggered_edges()
        output_str += str(file) + ":\n" + (
                "New Edges: {}, Triggered Edges: {}, Total Edges: {}, Coverage: {}%\n".format(
                    result.num_new_edges, triggered, total, float(triggered/total)))

    seed_cov_map_file = bitmap_directory+"/"+"scm.pickle"
    with open(seed_cov_map_file, "wb") as f:
        pickle.dump(seed_cov_map, f, protocol=pickle.HIGHEST_PROTOCOL)

    print("-- Seed Coverages Mapped --\n"+output_str)
    return seed_cov_map

# Load the dictionary which correlates seeds and their coverage bitmaps
def load_cor_maps(bms_directory):
    seed_cov_map_file = os.path.join(bms_directory,"scm.pickle")
    with open(seed_cov_map_file, 'rb') as f:
        seed_cov_map = pickle.load(f)
    print("-- Coverage Maps Loaded --\n")
    return seed_cov_map

def main():
    corpus_directory = sys.argv[1].split("/")[0]
    exec_engine = executor.Executor(timeout_per_execution_in_ms=400, enable_coverage=True)
    seed_cov_map = map_seed_bitmap(corpus_directory, exec_engine, "base_map_v8_1_12_24")
    no_new_edge_dir = corpus_directory+"_C0V"
    os.mkdir(no_new_edge_dir)
    for i in seed_cov_map:
        if "0bm" in seed_cov_map[i]:
            os.remove(seed_cov_map[i])
            os.rename(corpus_directory+"/"+i,no_new_edge_dir+"/"+i)
            #os.rename(seed_cov_map[i], no_new_edge_dir+"/"+seed_cov_map[i].split("/")[1])


if __name__ == "__main__":
    main()
