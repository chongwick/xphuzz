automated_python directory should be deleted soon.
javascript_fuzzing uses an LLM (potentially multiple in the future) as the mutation implementor. Mutations rules are implemented in the form of prompts to the LLM.
LLMs trained on code, specifically JavaScript, make them suitable for inserting mutations in a syntactically valid manner.
A Docker container (chongwick/ubun2.4) holds a modified version of V8 that was compiled using Fuzzili's coverage calculation strategy.
Fuzzing should be a (mostly) two-stage process: 
    1) Create the corpus
    2) Fuzz using the seeds from the corpus
Where 1 is used to create a moderately large corpus (500 seeds?) which is given to the instrumented JavaScript engine(s) for fuzzing. According to coverage calculations/other metrics, we can assign more energy to certain seeds while discarding others.

