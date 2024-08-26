<?php
require "/home/w023dtc/template.inc";


function iterate()
{
    yield 'foo';
    Fiber::suspend();
}

function f()
{
    return iterate();
}

$iterable = f();

function run($iterable)
{
    $callback = new Fiber(function () use (&$iterable) {
        foreach ($iterable as $v) {
            echo $v;
        }
        echo "end";
    });
    $callback->start();
}

run($iterable);

?>
