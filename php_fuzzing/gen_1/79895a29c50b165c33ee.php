<?php
require "/home/w023dtc/template.inc";

$vars[PHP_INT_MAX]->addAttribute(bin2hex(str_repeat(PHP_FLOAT_MAX, 257).str_repeat(PHP_INT_MIN, 4294967295)), 
    PHP_INT_MIN, 
    PHP_FLOAT_MIN);

function v0() {
    for ($i = 0; $i < 10; $i++) {
        $v1 = PHP_INT_MAX;
        $v2 = PHP_FLOAT_MAX;
        $v3 = PHP_INT_MIN;
        $v4 = PHP_FLOAT_MIN;
    }
}

v0();
v0();
v0();
?>
