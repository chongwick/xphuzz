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

function call_f() {
    global $mod; // Use the global variable $mod
    $i = 0;
    while ($i < 1000) { // Stop calling $mod['f'] after 1000 iterations
        $mod['f'](1); // Pass an argument to $f
        $i++;
    }
}

assertThrows(function() {
    $mod = array('f' => function() {
        throw new RangeError('Range error');
    });
    call_f();
}, RangeError::class);

?>
