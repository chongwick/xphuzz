<?php
require "/home/w023dtc/template.inc";


$a = array(0, 1);
$o = (object) array(
    'valueOf' => function() {
        $GLOBALS['a'] = array(0 => PHP_INT_MAX);
        return PHP_INT_MIN;
    }
);

$a[] = PHP_FLOAT_MAX;
echo array_search(PHP_FLOAT_MIN, $a, false);

?>
