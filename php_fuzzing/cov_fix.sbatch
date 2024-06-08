#!/usr/bin/bash
#SBATCH -N 1
#SBATCH --job-name=cov_fix
#SBATCH --output=cov_fix_output.txt
#SBATCH --error=cov_fix_error.txt
cd autest/php_fuzzing
singularity exec ../../ubuntu.sif python3 cov_fix.py
