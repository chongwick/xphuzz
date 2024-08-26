<?php
require "/home/w023dtc/template.inc";

ini_set('memory_limit', '512M'); // increase the memory limit to 512MB
$str2 = chr(0x2c); // add `,` into single character string
$str2 = str_repeat($str2, 0x400000); // adjust the value to avoid memory exhaustion

$floatArray = array_fill(0, PHP_INT_MAX, 1.1);
$floatArray = array_map(function($val) {
    return (float) $val;
}, $floatArray);

unserialize('O:8:"00000000":');
?>
