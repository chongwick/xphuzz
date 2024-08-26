<?php
require "/home/w023dtc/template.inc";


function bar($arg) {
    $ret = array('x' => $arg);
    $ret['__set'] = function($obj, $name, $value) {
        if ($value > PHP_INT_MAX || $value < PHP_INT_MIN) {
            // This should trigger a crash
            return "Error: Value out of range";
        }
        return "Success";
    };
    return $ret;
}

$test = bar(PHP_INT_MAX + 1);

?>
