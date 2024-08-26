<?php
require "/home/w023dtc/template.inc";


function assertThrows(callable $callback, $expectedException) {
    try {
        $callback();
        throw new Exception("Expected exception of type $expectedException, but no exception was thrown");
    } catch (TypeError $e) {
        return;
    } catch (Exception $e) {
        throw new Exception("Expected exception of type $expectedException, but got $e");
    }
}

if (extension_loaded('bcmath')) {
    assertThrows(function() { bcmul(PHP_INT_MAX, PHP_INT_MIN, 0); }, 'DomainError');
} else {
    echo "The bcmath extension is not installed.";
}

?>
