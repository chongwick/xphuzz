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

$array = array();

define('PHP_INT_MAX', null);

define('1.7976931348623157e+308', null, true);

if (in_array(PHP_INT_MIN, $array)) {
    assertThrows('assert(die());');
}

?>
