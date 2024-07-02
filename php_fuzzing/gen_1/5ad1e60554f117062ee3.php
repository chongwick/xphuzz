<?php

function doShift($a) {
    $x = array_shift($a);
    return $x;
}

function makeArray() {
    $a = array(1, 2, null, 3);
    $a[0] = 2;
    return $a;
}

doShift(makeArray());
doShift(makeArray());
$doShift = function ($a) {
    return array_shift($a);
};
doShift(makeArray());
assert($doShift([1, 2, null, 3]) === 1);

function test($foo) {
    try {
        $foo();
    } catch (Exception $e) {
        // Do nothing, just to simulate the behavior
    }
    echo "Optimized function called.\n";
    try {
        $foo();
    } catch (Exception $e) {
        // Do nothing, just to simulate the behavior
    }
}

class A {}

test(function(...$args) {
    $reflection = new ReflectionClass('A');
    $reflection->newInstanceArgs($args);
});

test(function(...$args) {
    $reflection = new ReflectionClass('A');
    $reflection->newInstanceArgs($args);
});

test(function(...$args) {
    $reflection = new ReflectionClass('A');
    $reflection->newInstanceArgs($args);
});

test(function(...$args) {
    $reflection = new ReflectionClass('A');
    $reflection->newInstanceArgs($args);
});

test(function(...$args) {
    $reflection = new ReflectionClass('A');
    $reflection->newInstanceArgs($args);
});

test(function(...$args) {
    $reflection = new ReflectionClass('A');
    $reflection->newInstanceArgs($args);
});

test(function() {
    $reflection = new ReflectionClass('A');
    $reflection->newInstanceArgs(func_get_args());
});

test(function() {
    $reflection = new ReflectionClass('A');
    $reflection->newInstanceArgs(func_get_args());
});

test(function() {
    $reflection = new ReflectionClass('A');
    $reflection->newInstanceArgs(func_get_args());
});

test(function() {
    $reflection = new ReflectionClass('A');
    $reflection->newInstanceArgs(func_get_args());
});

test(function() {
    $reflection = new ReflectionClass('A');
    $reflection->newInstanceArgs(func_get_args());
});

test(function() {
    $reflection = new ReflectionClass('A');
    $reflection->newInstanceArgs(func_get_args());
});

function test($x) {
    return array($x, null, null);
}

test(0);
test(0);
$test = function ($x) {
    return array($x, null, null);
};
test(0);

?>
