<?php
require "/home/w023dtc/template.inc";


function assertThrows($expression) {
    try {
        eval($expression);
        throw new Exception("Expected exception not thrown");
    } catch (Exception $e) {
        // do nothing
    }
}

assertThrows('assert(unserialize("O:8:"'.PHP_INT_MAX.'":"));');

?>
