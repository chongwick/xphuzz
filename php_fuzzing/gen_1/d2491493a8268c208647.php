<?php
require "/home/w023dtc/template.inc";


ini_set('memory_limit', PHP_INT_MAX);

function assertThrows(callable $callback) {
    try {
        $callback();
        throw new Exception('Expected exception not thrown');
    } catch (OutOfMemoryError $e) {
        // expected
    }
}

assertThrows(function() {
    $largeArray = array_fill(0, PHP_INT_MAX, 'x');
});

?>
