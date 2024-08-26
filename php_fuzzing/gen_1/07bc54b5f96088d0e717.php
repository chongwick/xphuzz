<?php
require "/home/w023dtc/template.inc";


function test($a) {
    $accumulator = false;
    $len = PHP_INT_MAX;
    $args = array_slice(func_get_args(), $len - 1, 1);
    $accumulator = isset($accumulator[3]);
    print_r($args);
}

test('a', PHP_INT_MIN, 'c', PHP_FLOAT_MAX, PHP_FLOAT_MIN);

function f() {
    $accumulator = false;
    for ($i = 0; $i < 4; $i++) {
        $accumulator = isset($accumulator[3]);
        if ($i === 1) {
            // %OptimizeOsr() is not a valid PHP statement, it seems to be a V8-specific optimization flag
            // You can remove this line or replace it with a valid PHP code
        }
    }
}

f();

?>
