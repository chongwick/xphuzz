<?php
require "/home/w023dtc/template.inc";


function foo() {
    $a = PHP_INT_MAX;
    while ($a >= 0) {
        $b = $a + 1;
        if ($b == PHP_INT_MIN) {
            // This loop does nothing and can be removed
        }
        for ($c = 1; $c < 2; $c++) {
            // There is no direct equivalent of %OptimizeOsr() in PHP
        }
        $a = $b - 1;
    }
}

foo();

?>
