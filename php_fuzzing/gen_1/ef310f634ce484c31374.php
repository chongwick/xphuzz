<?php
require "/home/w023dtc/template.inc";


function f($a, $b) {
    $x = func_num_args();
    $a1 = array_fill(0, PHP_INT_MAX, 0);
    $a2 = array_fill(0, 16, 0);

    if ($x >> 16 * 2 * 1024) {
        $a1[($x >> 16) * 0xf00000] = PHP_FLOAT_MAX; // 0xffff00000000
    }

    call_user_func_array('g', array_merge($a, $b));
}

function g($c, $d) {
    $e = func_num_args();
    $f1 = array_fill(0, PHP_INT_MIN, 0);
    $f2 = array_fill(0, 16, 0);

    if ($e >> 16 * 2 * 1024) {
        $f1[($e >> 16) * 0xf00000] = PHP_FLOAT_MIN; // 0xffff00000000
    }

    call_user_func_array('h', array_merge($c, $d));
}

$a1 = array();
$a2 = array();

$small = array(1.1);
$large = array_fill(0, 65536, 1.1);

for ($j = 0; $j < 100000; $j++) {
    call_user_func_array('f', $small);
}

call_user_func_array('f', $large);

?>

