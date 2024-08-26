<?php
require "/home/w023dtc/template.inc";


function test() {
    $a = array();
    $a[$PHP_INT_MAX] = 'a';
    $a[$PHP_INT_MIN] = 'b';
    $a[PHP_FLOAT_MAX] = 'c';
    $a[PHP_FLOAT_MIN] = 'd';
}

test();

?>
