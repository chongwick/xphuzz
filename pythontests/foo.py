import numpy
import inspect
lib_methods=[]
for obj_ in dir(numpy):
    obj = getattr(numpy, obj_)
    if callable(obj) and obj.__doc__ != None:
        lib_methods.append(obj)
#print(len(lib_methods))
print(lib_methods[11], lib_methods[11].__doc__)
#print(help(lib_methods[0]))
#print(inspect.signature(lib_methods[0]))
