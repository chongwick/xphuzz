<?php
require "/home/w023dtc/template.inc";


function assertThrows(callable $callback) {
    try {
        $callback();
        throw new Exception('Expected exception not thrown');
    } catch (TypeError $e) {
        // expected
    }
}

function fiberLoop() {
    $memory = new stdClass();
    $memory->initial = PHP_INT_MAX;
    $array = new SplFixedArray(1);
    $array[0] = $memory;
    $gen = new It();
    foreach ($gen as $key => $value) {
        $array[0]->initial += 1;
        if ($array[0]->initial > PHP_INT_MAX) {
            break;
        }
    }
    var_dump("end");
}

assertThrows(function() {
    fiberLoop();
});

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

?>
