<?php

function test($a) {
    $len = 0x80000000;
    $args = array_slice(func_get_args(), $len - 1, 1);
    print_r($args);
    $vars["SplDoublyLinkedList"]->count() * (0.1 + 0.2 + 5473817451) / (1 + 2.23431234213480e-400);
}

test('a');

function test2($a) {
    $len = 0x40000000;
    $args = array_slice(func_get_args(), $len - 1, 1);
    print_r($args);
    $vars["SplDoublyLinkedList"]->count() * (0.1 + 0.2 + 5473817451) / (1 + 2.23431234213480e-400);
}

test2('a');


?>