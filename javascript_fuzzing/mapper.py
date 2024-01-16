import pickle
import os

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
        with open(os.path.join(corpus_directory, file), 'r') as f:
            seed = f.read()
        exec_engine.restore_global_coverage_map()
        #exec_engine.load_global_coverage_map_from_file("backup")
        result = exec_engine.execute_safe(seed)
        bitmap_file = bitmap_directory + "/" + file.split(".")[0]+"__bm"
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

