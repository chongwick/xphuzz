<?php

function test($a) {
    $len = 0x80000000;
    $args = array_slice(func_get_args(), $len - 1, 1);
    print_r($args);
}

test('a');

function test2($a) {
    $len = 0x40000000;
    $args = array_slice(func_get_args(), $len - 1, 1);
    print_r($args);
}

test2('a');

?>
