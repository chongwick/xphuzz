#!/usr/bin/bash
#SBATCH -N 1
#SBATCH -G 1
#SBATCH --job-name=llama_query
#SBATCH --output=llama_query
#SBATCH --time=00:15:00
mkdir new
cd new
pwd
#SBATCH --cpus-per-task=1
#SBATCH --tasks-per-node=16
