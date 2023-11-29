import numpy
import inspect
import pandas
import flask

#get all standard functions
def get_doc_str():
    lib_methods=[]
    for obj_ in dir(flask):
        obj = getattr(flask, obj_)
        if inspect.isfunction(obj) and obj.__doc__ != None:
            lib_methods.append(obj)

    return(str(numpy.matmul) + str(numpy.matmul.__doc__))
    return(str(lib_methods[12]) + str(lib_methods[12].__doc__))

#return defined exceptions for standard function
def get_exceptions(obj):
    obj = numpy.loadtxt
    try:
        file=inspect.getfile(obj)
    except TypeError as e:
        return None
    return file
        
#print(get_exceptions(None))
