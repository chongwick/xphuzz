<?php

class It implements \IteratorAggregate
{
    public function getIterator(): \Generator
    {
        yield 'foo';
        Fiber::suspend();
    }
}

function f() {
    yield from new It();
}

$iterable = f();

$loop = new Fiber(function () use (&$callback) {
    $callback->start();
});

$callback = new Fiber(function () use ($iterable) {
    $iterable->next();
    $iterable->next();
    var_dump("end");
});

$loop->start();
