<?php
require "/home/w023dtc/template.inc";


$var = PHP_INT_MAX;
$var.= str_repeat(chr(PHP_INT_MAX), PHP_INT_MAX);
$var.= PHP_INT_MIN;
$var.= str_repeat(chr(PHP_INT_MIN), PHP_INT_MIN);

echo serialize($var);

unset($var);

echo PHP_FLOAT_MAX. PHP_FLOAT_MIN;

?>
