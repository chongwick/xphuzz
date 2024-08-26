<?php
require "/home/w023dtc/template.inc";


try {
    $a = array();
    $a[PHP_INT_MAX] = new stdClass();
    $a[PHP_INT_MAX]->__v_0 = range(PHP_INT_MIN, PHP_FLOAT_MAX);
    foreach ($a[PHP_INT_MAX]->__v_0 as $__v_1) {
        // do nothing
    }
    $e = ($a = ($b = []) + $b) + $a;
} catch (Exception $e) {
    // do nothing
}

?>
