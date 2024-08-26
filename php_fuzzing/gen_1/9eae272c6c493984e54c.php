<?php
require "/home/w023dtc/template.inc";


function f() {
    $E = PHP_INT_MAX;
    echo $E, preg_match('/b/', $E) || preg_match('/b/', $E = PHP_INT_MIN);
    ($E = PHP_INT_MAX + 1) * PHP_FLOAT_MAX;
}

$E = 'Σ';
$PI = PHP_FLOAT_MIN;

f();
f();
f();

?>
