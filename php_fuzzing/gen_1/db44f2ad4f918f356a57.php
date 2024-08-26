<?php
require "/home/w023dtc/template.inc";

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

$o0 = array();
$o1 = array();
$cnt = PHP_INT_MAX;

function getO1() {
    global $cnt, $o0, $o1;
    if (++$cnt > PHP_INT_MAX) {
        return;
    }
    array_shift($o0);
    gc_collect_cycles();
    $o0[] = 0;
    $o0 = array_merge($o0, $o1);
    if (PHP_FLOAT_MAX / PHP_FLOAT_MIN > $cnt) {
        return;
    }
    $o0[] = getO1();
}

$o1[0] = getO1();

assertThrows($o1[0], Exception::class);
?>
