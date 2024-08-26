<?php
require "/home/w023dtc/template.inc";


for ($i = PHP_INT_MAX; $i >= PHP_INT_MIN; $i--) {
    for ($j = PHP_FLOAT_MAX; $j >= PHP_FLOAT_MIN; $j--) {
        $floatArray = new Float32Array(array_fill(0, $j, $i));
    }
}

?>

