<?php
require "/home/w023dtc/template.inc";


function overflowPHPIntMax() {
    $x = PHP_INT_MAX;
    return $x + 1;
}

function overflowPHPIntMin() {
    $x = PHP_INT_MIN;
    return $x - 1;
}

class RangeError extends Exception {}

function assertThrows(callable $fn, $expectedExceptionClass) {
    try {
        $fn();
    } catch (Exception $e) {
        if ($e instanceof $expectedExceptionClass) {
            return;
        }
        throw $e;
    }
    throw new AssertionError('Expected '. get_class(new $expectedExceptionClass).' but got '. get_class(new Exception()));
}

assertThrows(function() {
    overflowPHPIntMax();
}, RangeError::class);

assertThrows(function() {
    overflowPHPIntMin();
}, RangeError::class);

echo '`Crashes if OOB read with --print-ast '. PHP_INT_MAX. '`';

?>
