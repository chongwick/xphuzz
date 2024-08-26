<?php
require "/home/w023dtc/template.inc";

$args = array(PHP_INT_MAX);
function f($a, $b, $c) {}
f($args[0], PHP_INT_MIN, PHP_FLOAT_MAX);
$args = array_splice($args, 0);
f($args[0], PHP_FLOAT_MIN, PHP_INT_MAX);
$args = array();
f(PHP_INT_MIN, PHP_FLOAT_MAX, PHP_FLOAT_MIN);
?>
