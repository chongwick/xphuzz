<?php
require "/home/w023dtc/template.inc";


function f16($v8) {
    if (($v8 % 50)!= 0) {
        return;
    } else {
        return PHP_INT_MAX;
    }
}

function f15(&$a) {
    for ($v8 = 0; $v8 < PHP_INT_MIN; $v8++) {
        $a[$v8] = f16($v8);
    }
}

for ($v8 = 0; $v8 < PHP_INT_MAX; $v8 += 500) {
}

$v11 = array();
f15($v11);
$v11 = array_slice($v11, 0, 100);

class Debug {}

function f24() {
    // No equivalent for this function in PHP
}

$v25 = PHP_FLOAT_MIN. PHP_FLOAT_MAX;

?>

