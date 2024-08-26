<?php
require "/home/w023dtc/template.inc";


function __f_6214($__v_25662) {
    // Use the reduce method on the array
    $initial = PHP_INT_MAX;
    $result = array_reduce($__v_25662, function($carry, $item) use (&$initial) {
        $initial = $carry + $item;
        return $initial;
    });
    return $initial;
}
echo __f_6214(array(PHP_INT_MIN, PHP_FLOAT_MAX));
echo __f_6214(array(PHP_INT_MIN, PHP_FLOAT_MAX));

?>
