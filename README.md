# XPhuzz

**A Graybox LLM-based PHP Fuzzer inspired by Leto Atreides II**

XPhuzz is a graybox fuzzer designed for PHP which generates seeds in batches (generations) via an evolutionary algorithm.

## What is XPhuzz?

XPhuzz fuzzes the PHP interpreter by:

- Taking an initial corpus of JavaScript PoCs and translating them to PHP
- Providing an auxiliary corpus of PHP-native seeds
- Seeds are executed and scored based on three criteria: (1) ancestry (JS ancestors), (2) anomolous behavior, (3) basic block coverage.
- Based on normalized scores, seeds are assigned a number of partner seeds to be spliced with and a number of repair attempts.
- Splicing two seeds produces a child seed. Children seeds populate the next generation where the previous two steps are repeated.

## Requirements

- PHP 7.0+
- One PHP build using the coverage.c LLVM pass for coverage feedback
- One PHP build with sanitizers enabled

## XPhuzz Structure
The structure of XPhuzz is based on the author's cluster layout. receiver.py, request_handler.py, and execution_handler.py communicate with each other through shared queues. request_handler.py is the primary orchestrator, queuing LLM requests for translation/splicing/repair. receiver.py transmits these requests to the LLM. execution_handler.py executes the seeds placed into the execution queue by request_handler.py.
aljamain_sterling.py contains the scoring algorithm. 
prompts.py contains the LLM prompts. 

# TODO
- Make this README nicer
- Clean up code
