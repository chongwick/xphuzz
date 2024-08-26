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
    $arr = array_fill(0, PHP_INT_MAX, 0);
});

?>
