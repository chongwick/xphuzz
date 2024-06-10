<?php

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
    throw new RangeError('Range error');
}, RangeError::class);

?>
