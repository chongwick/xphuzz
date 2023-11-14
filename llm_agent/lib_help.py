import numpy
import inspect
import pandas

#get all standard functions
def get_doc_str():
    lib_methods=[]
    for obj_ in dir(pandas):
        obj = getattr(pandas, obj_)
        if inspect.isfunction(obj) and obj.__doc__ != None:
            lib_methods.append(obj)

    return(str(numpy.matmul) + str(numpy.matmul.__doc__))
    return(str(numpy.loadtxt) + str(numpy.loadtxt.__doc__))
    return(str(lib_methods[21]) + str(lib_methods[21].__doc__))

#return defined exceptions for standard function
def get_exceptions(obj):
    obj = numpy.loadtxt
    try:
        file=inspect.getfile(obj)
    except TypeError as e:
        return None
    return file
        

#print(get_exceptions(None))
