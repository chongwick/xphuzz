import atheris
import sys

def foo(arg):
    if arg == b"bad":
        raise RuntimeError("bad")
def TestOneInput(data):
    try:
        foo(data)
    except Exception as e:
        print(e)

atheris.instrument_all()
atheris.Setup(sys.argv, TestOneInput)
atheris.Fuzz()
