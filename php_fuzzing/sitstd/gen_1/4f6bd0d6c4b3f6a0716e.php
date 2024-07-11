<?php

function f() {
    $o = array();
    $o['a'] = 0;
    $o[1024] = 1; // An offset of >=1024 is required
    unset($o['a']);
    $o['b'] = 2;
    return $o['b'];
}

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

function assertThrows($callable, $expectedException) {
    try {
        $callable();
    } catch (Throwable $e) {
        if (!($e instanceof $expectedException)) {
            throw new AssertionError('Assertion failed');
        }
        throw $e;
    }
    throw new AssertionError('Assertion failed');
}

assertThrows(function() {
    f();
    f();
    f();
}, 'Notice');

assertThrows(function() {
    h();
    h();
    h();
}, 'Notice');

?>
