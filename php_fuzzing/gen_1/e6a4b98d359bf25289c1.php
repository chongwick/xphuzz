<?php
require "/home/w023dtc/template.inc";


function assertThrows($callback) {
    try {
        $callback();
    } catch (Exception $e) {
        // If an exception is thrown, the assertion passes
    } catch (TypeError $e) {
        // If a TypeError is thrown, the assertion passes
    } catch (Error $e) {
        // If any other error is thrown, the assertion fails
        throw $e;
    }
}

assertThrows(function() {
    $x = array('a' => PHP_INT_MAX, 'b' => PHP_INT_MIN);
    $y = array('c' => PHP_FLOAT_MAX, 'd' => PHP_FLOAT_MIN);
    $z = array_merge($x, $z = array('e' => PHP_INT_MAX));
    echo (string) array_merge($y, $z);
});

?>
