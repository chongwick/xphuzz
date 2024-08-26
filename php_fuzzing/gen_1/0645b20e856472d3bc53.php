<?php
require "/home/w023dtc/template.inc";

ini_set('memory_limit', PHP_INT_MAX); // increase the memory limit to maximum
$str2 = chr(0x2c); // add `,` into single character string
$str2 = str_repeat($str2, PHP_INT_MAX); // adjust the value to overflow memory

function crash() {
    $x = new stdClass();
    $x->{chr(0x2c)} = array();
    $x->{chr(0x2c)}[PHP_INT_MAX] = array();
    $x->{chr(0x2c)}[PHP_INT_MAX][PHP_FLOAT_MAX] = array();
    //...
    $x->{chr(0x2c)}[PHP_INT_MAX][PHP_FLOAT_MAX][PHP_INT_MIN] = array();
}

crash();
?>
