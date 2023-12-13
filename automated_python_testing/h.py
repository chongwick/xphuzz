import xml.etree.ElementTree as ET
import atheris
import sys

def foo(a,b):
    if a != 7:
        return
    if b != 8:
        return
    raise RuntimeError("done")

def TestOneInput(input_bytes):
    fdp = atheris.FuzzedDataProvider(input_bytes)
    l = [0,1,2,3,4,5,6,7,8,9]
    data1 = fdp.PickValueInList(l)
    data2 = fdp.PickValueInList(l)
    foo(data1, data2)

def main():
    atheris.Setup(sys.argv, TestOneInput)
    atheris.Fuzz()

if __name__ == "__main__":
    atheris.instrument_all()
    main()
