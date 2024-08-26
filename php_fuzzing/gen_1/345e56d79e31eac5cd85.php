<?php
require "/home/w023dtc/template.inc";


if (class_exists('Worker')) {
    function __f_4() {}
    $__v_2 = new Worker(__f_4);
    $a = PHP_INT_MAX;
    $b = PHP_INT_MIN;
    $c = PHP_FLOAT_MAX;
    $d = PHP_FLOAT_MIN;
    $e = $c + $d;
    $f = serialize(array_merge(array_slice(array_slice(array_slice(array(), 0, $e / 8), 7, 1, true), 0, $e / 8, true), array($hex_b = 0x0b, $hex_d = 0x0d, $hex_20 = 0x20, $hex_52 = 0x52, $hex_fe = 0xfe)));
    f($a);
    f($b);
}

function f($a) {
    $unused = array_merge(array_slice(array_slice(array_slice(array(), 0, $a / 8), 7, 1, true), 0, $a / 8, true), array($hex_b));
}

f(64);
f(64);

?>
