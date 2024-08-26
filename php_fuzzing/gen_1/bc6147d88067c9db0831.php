<?php
require "/home/w023dtc/template.inc";


function f() {
    echo $E = 2, preg_match('/b/', $E) || preg_match('/b/', $E = 2);
    ($E = 3) * PHP_FLOAT_MAX;
}

$E = 'Σ';
$PI = PHP_INT_MAX;

$loop = new Fiber(function () use (&$callback) {
    $callback->start();
});

$callback = new Fiber(function () use ($E) {
    $E;
    Fiber::suspend();
});

$loop->start();

f();
f();
f();

?>
