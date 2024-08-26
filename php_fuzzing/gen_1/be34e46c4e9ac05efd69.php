<?php
require "/home/w023dtc/template.inc";

function foo($x) {
    return $x | PHP_INT_MAX;
}

if (foo(PHP_INT_MIN)!== PHP_INT_MAX) {
    echo "Expect PHP_INT_MAX, but got ". foo(PHP_INT_MIN). "\n";
}

function makeFoo($y) {
    return function ($x) use ($y) {
        return $x | PHP_INT_MAX == $y;
    };
}

$foo0 = makeFoo(PHP_INT_MAX);

if ($foo0(PHP_INT_MIN)!== true) {
    echo "Expect true, but got ". $foo0(PHP_INT_MIN). "\n";
}

$foo1 = makeFoo(PHP_FLOAT_MIN);

if ($foo1(PHP_INT_MIN)!== false) {
    echo "Expect false, but got ". $foo1(PHP_INT_MIN). "\n";
}

$foo2 = makeFoo(PHP_FLOAT_MAX);

if ($foo2(PHP_INT_MIN)!== false) {
    echo "Expect false, but got ". $foo2(PHP_INT_MIN). "\n";
}
?>
