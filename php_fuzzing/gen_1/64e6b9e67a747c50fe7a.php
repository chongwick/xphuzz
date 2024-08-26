<?php
require "/home/w023dtc/template.inc";


function crash() {
    $arr = array();
    $arr[PHP_INT_MAX] = str_repeat(chr(PHP_INT_MAX), 257);
    $arr[PHP_INT_MIN] = bin2hex(str_repeat(chr(PHP_INT_MIN), 257). str_repeat(chr(PHP_FLOAT_MAX), 17). str_repeat(chr(PHP_FLOAT_MIN), 4097));
    $arr[PHP_FLOAT_MAX] = bin2hex(str_repeat(chr(PHP_FLOAT_MAX), 65537). str_repeat(chr(PHP_FLOAT_MIN), 1025). str_repeat(chr(PHP_FLOAT_MAX), 1025));
    $arr[PHP_FLOAT_MIN] = str_repeat(chr(PHP_FLOAT_MIN), 257);
    return unserialize(serialize($arr));
}

crash();

?>
