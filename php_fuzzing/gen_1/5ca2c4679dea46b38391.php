<?php
require "/home/w023dtc/template.inc";


function foo($arg) {
    $ret = array();
    $ret[PHP_INT_MAX] = $arg;
    $ret['__set'] = function($obj, $name, $value) {
        // Do nothing
    };
    return $ret;
}

// Trigger a set on the object
foo(PHP_FLOAT_MAX)['PHP_INT_MIN'] = PHP_FLOAT_MIN;

?>
