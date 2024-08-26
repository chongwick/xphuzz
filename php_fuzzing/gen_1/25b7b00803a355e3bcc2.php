<?php
require "/home/w023dtc/template.inc";


function foo($a, array $b) {
    $x = $a + $b;
    try {
        $x['symbol'] = 42; // Use quotes for string keys
        new \stdClass();
    } catch (Exception $e) {}
}

function test() {
    try {
        foo(PHP_INT_MAX, array());
    } catch (Exception $e) {}
}

test();
test();
test();

?>
