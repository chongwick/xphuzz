<?php
require "/home/w023dtc/template.inc";

function f($v) {
    return func_get_args();
}

function boom($v) {
    $m32 = array_fill(0, 256, 0);
    $ff = function($x) {
        return ($x > 0)? 1 : (($x < 0)? -1 : 0);
    };
    $m32[($ff(is_nan($v))? 1 : -1) % 0xdc4e153 & PHP_INT_MAX] = PHP_INT_MIN;
    return f($m32);
}

$result = boom(PHP_INT_MAX);

assert(count($result) == 1);
assert($result[0] === PHP_INT_MIN);

$result = boom(PHP_INT_MIN);

assert(count($result) == 1);
assert($result[0] === PHP_INT_MAX);

?>
