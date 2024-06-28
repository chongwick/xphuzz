from timeout import timeout, TimeoutError

@timeout(2)
def foo():
    i = 0
    while i < 10000000000000:
        i+=1
    print('hi')

try:
    foo()
except TimeoutError as e:
    print("timedout")
