<?php
require "/home/w023dtc/template.inc";


const E = '"use asm";';

function f($x = PHP_INT_MAX) {
    $y = PHP_INT_MIN;
    if ($y == $x) {
        // LOCALS
    }
    $z = PHP_FLOAT_MAX;
    if ($z == $y) {
        // LOCALS
    }
    $w = PHP_FLOAT_MIN;
    if ($w == $z) {
        for ($i = 0; $i < 40000; $i++) {
            $src = array_merge((array)$i, array('x' => $w));
            $clone = array_merge((array)$src);
        }
    }
}

f();

?>
