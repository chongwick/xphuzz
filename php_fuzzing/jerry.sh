#singularity exec -H /home/w023dtc/jsxphuzz/php_fuzzing:/home --containall ls
singularity exec -H /home/w023dtc/jsxphuzz/php_fuzzing:/home --bind .local:/home/.local --bind sifs:/home/sifs --bind /home/w023dtc/js_engines:/home/js_engines --containall /home/w023dtc/sifs/jerrydock.sif ./js_engines/jerry $1
