<?php

function f() {
    $o = array();
    $o['a'] = 0;
    $o[1024] = 1; // An offset of >=1024 is required
    unset($o['a']);
    $o['b'] = 2;
    return $o['b'];
}

f();
f();
f();

function g($o) {
    $o['b'] = 2;
}

function h() {
    $o = array();
    $o['a'] = 0;
    $o[1024] = 1;
    unset($o['a']);
    g($o);
    return $o['b'];
}

h();
h();
h();

?>
