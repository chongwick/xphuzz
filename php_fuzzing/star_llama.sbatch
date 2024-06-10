#!/usr/bin/bash
#SBATCH -N 1
#SBATCH --tasks-per-node=16
#SBATCH --job-name=star_llama
#SBATCH --partition=a100
#SBATCH --gres=gpu:01
#SBATCH --output=star_output.txt
#SBATCH --error=star_error.txt
cd autest/php_fuzzing
python3 star_llama.py
