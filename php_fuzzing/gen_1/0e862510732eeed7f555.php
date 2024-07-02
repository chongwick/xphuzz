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
    stream_context_set_params(fopen("5473817451", "w"), array_map("sqrt", range(0, 10)));
}, RangeError::class);

?>
