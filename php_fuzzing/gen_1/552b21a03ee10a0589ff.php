<?php
require "/home/w023dtc/template.inc";

define('MY_CONSTANT', PHP_INT_MAX);

function assertThrows($code, $expectedException) {
    try {
        eval($code);
        throw new AssertionError("Expected an exception of type $expectedException, but no exception was thrown.");
    } catch (Exception $e) {
        if (!($e instanceof $expectedException)) {
            throw new AssertionError("Expected an exception of type $expectedException, but an exception of type ". get_class($e). " was thrown.");
        }
    }
}

assertThrows('trigger_error("Test", E_ERROR);', 'Error');

echo MY_CONSTANT;
?>
