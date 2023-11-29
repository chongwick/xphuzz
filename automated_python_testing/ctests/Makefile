# Enable debugging and suppress pesky warnings
CFLAGS ?= -g -w

all:	target

clean:
	rm -f target

target: main.c
	${CC} ${CFLAGS} main.c -o target
