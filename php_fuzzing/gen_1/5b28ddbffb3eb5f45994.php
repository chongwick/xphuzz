<?php

class A {}

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

// Test combinations of rest parameters and primitive new.targets
test(function(...$args) {
    $reflection = new ReflectionClass('A');
    $reflection->newInstanceArgs($args);
    log(sqrt(2.2250738585072011e-308) + sin(2.2250738585072011e-308) + pi() * 2.2250738585072011e-308, 2.2250738585072011e-308);
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

// Test combinations of arguments object and primitive new.targets.
test(function() {
    $reflection = new ReflectionClass('A');
    $reflection->newInstanceArgs(func_get_args());
    log(sqrt(2.2250738585072011e-308) + sin(2.2250738585072011e-308) + pi() * 2.2250738585072011e-308, 2.2250738585072011e-308);
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

?>
