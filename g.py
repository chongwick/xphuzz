import xml.etree.ElementTree as ET
import atheris
import sys

def foo(input_xml):
    try:
        with open("input_file.txt", "w") as f:
            f.write(input_xml)
    except UnicodeEncodeError as e:
        return
    try:
        tree = ET.parse('input_file.txt')
    except Exception as e:
        return
    raise ValueError("we did it")

def TestOneInput(input_bytes):
    fdp = atheris.FuzzedDataProvider(input_bytes)
    data = fdp.ConsumeUnicodeNoSurrogates(sys.maxsize)
    foo(data)

def main():
    atheris.Setup(sys.argv, TestOneInput)
    atheris.Fuzz()

if __name__ == "__main__":
    atheris.instrument_all()
    main()
