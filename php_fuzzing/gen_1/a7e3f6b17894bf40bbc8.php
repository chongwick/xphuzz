<?php
require "/home/w023dtc/template.inc";


function opt($arg) {
    $x = func_num_args();
    $a1 = array_fill(0, PHP_INT_MAX, null);
    $a2 = array(1.1, 1.1);
    $a1[($x >> 16) * 0xf00000] = PHP_FLOAT_MIN; // 0x1p-1075
}

$a1 = array();
$a2 = array();

$small = array(1.1);
$large = array(1.1, 1.1);
$large = array_pad($large, 65536, 1.1);

for ($j = 0; $j < 100000; $j++) {
    opt(...$small);
}

// Trigger bug
opt(...$large);

function foo() {
    return [null, PHP_INT_MIN];
}

echo foo()[0];
echo foo()[0];
$foo = fn() => var_export(foo(), true);
$foo();
echo foo()[0];

?>

