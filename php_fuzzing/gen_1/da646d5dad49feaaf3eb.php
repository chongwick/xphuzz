<?php
require "/home/w023dtc/template.inc";


function foo() {
    global $x;
    $x = PHP_INT_MAX;
    throw new Exception('Test exception');
}

$x = PHP_INT_MIN;

function assertThrows($callback) {
    try {
        $callback();
        throw new AssertionError('Expected exception not thrown');
    } catch (Exception $e) {
        // do nothing
    }
}

assertThrows(function() { foo(); });

echo hexdec(str_repeat("π", PHP_INT_MAX). str_repeat("e", PHP_INT_MAX). str_repeat("∞", PHP_INT_MAX));

?>
