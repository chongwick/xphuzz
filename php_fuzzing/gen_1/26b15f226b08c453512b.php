<?php
require "/home/w023dtc/template.inc";


function f() {
    $o = array();
    $o[PHP_INT_MAX] = 1; // An offset of >=1024 is required
    unset($o[PHP_INT_MAX]);
    $o['b'] = 2;
    return $o['b'];
}

f();
f();
f();

function g($o) {
    $o['b'] = 2;
    $o[PHP_INT_MIN] = 3;
}

function h() {
    $o = array();
    $o['a'] = 0;
    $o[1024] = 1;
    unset($o['a']);
    g($o);
    return $o[PHP_FLOAT_MAX];
}

h();
h();
h();

?>
