<?php

function foo() {
    global $x;
    $x = 42;
    throw new Exception('Test exception');
}

$x = 1;

function assertThrows($callback) {
    try {
        $callback();
        throw new AssertionError('Expected exception not thrown');
    } catch (Exception $e) {
        // do nothing
    }
}

assertThrows(function() { foo(); });

?>
