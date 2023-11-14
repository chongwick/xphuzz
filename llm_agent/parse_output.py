import re

def write_harnesses(filename):
    harnesses = []
    with open(filename, "r") as f:
        content=f.read()
    for i in content.split('```'):
        if ".py" not in i and "import" in i:
            harnesses.append(i.replace("python",""))
    for i in range(len(harnesses)):
        filename = "harnesses/" + "harness" + str(i) + ".py"
        with open(filename, "w") as f:
            f.write(harnesses[i])

write_harnesses("llm_out.txt")
