<?php
require "/home/w023dtc/template.inc";


$a = array(PHP_INT_MAX);
$b = (object) array(
    'valueOf' => function() {
        $GLOBALS['a'] = array(PHP_INT_MIN);
        return PHP_FLOAT_MAX;
    }
);

$a[] = PHP_FLOAT_MIN;
echo array_search(PHP_INT_MAX, $a, false);

?>
