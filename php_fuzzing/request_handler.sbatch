#!/usr/bin/bash
#SBATCH -N 1
#SBATCH --job-name=request_handler
#SBATCH --output=requests_output.txt
#SBATCH --error=requests_error.txt
cd autest/php_fuzzing
python3 request_handler.py
