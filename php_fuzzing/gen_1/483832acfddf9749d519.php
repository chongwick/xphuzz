<?php
require "/home/w023dtc/template.inc";


function test($a) {
    $len = PHP_INT_MAX;
    $args = array_slice(func_get_args(), $len - 1, 1);
    print_r($args);
}

test(PHP_INT_MIN);

function test2($a) {
    $len = PHP_INT_MAX;
    $args = array_slice(func_get_args(), $len - 1, 1);
    print_r($args);
}

test2(PHP_FLOAT_MAX);

function test3($a) {
    $len = PHP_INT_MIN;
    $args = array_slice(func_get_args(), $len - 1, 1);
    print_r($args);
}

test3(PHP_FLOAT_MIN);

?>

