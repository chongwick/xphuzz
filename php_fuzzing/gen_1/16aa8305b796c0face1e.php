<?php
require "/home/w023dtc/template.inc";


function __f_1($a, $b) {
    return $a + $b;
}

function __f_0() {
    $__v_1 = 1 + PHP_INT_MAX;
    $__v_2 = PHP_INT_MIN;
    $__v_3 = PHP_FLOAT_MAX;
    $__v_4 = PHP_FLOAT_MIN;
    return array($__v_1, $__v_2, $__v_3, $__v_4);
}

try {
    __f_0();
    __f_0();
    __f_0();
} catch (Exception $e) {
    // do nothing
}

$a = null;
$b = null;

for ($i = 0; $i < 100000; $i++) {
    $b = 1;
    $a = $i + PHP_INT_MAX;  // PHP_INT_MAX is an integer, so this will make "$a" an integer.
    $b = $a;
}

var_dump($a === $b);
gc_collect_cycles();
var_dump($a === $b);

?>
