
import atheris
import sys
import numpy as np

def TestOneInput(input_bytes):
    fdp = atheris.FuzzedDataProvider(input_bytes)
    x1 = fdp.ConsumeFloatListInRange(4, -1.0, 1.0)
    x2 = fdp.ConsumeFloatListInRange(4, -1.0, 1.0)
    np.matmul(x1, x2)

def main():
    atheris.Setup(sys.argv, TestOneInput)
    atheris.Fuzz()

if __name__ == "__main__":
    atheris.instrument_all()
    main()
