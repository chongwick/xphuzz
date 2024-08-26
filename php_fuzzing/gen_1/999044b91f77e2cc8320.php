<?php
require "/home/w023dtc/template.inc";


function f($i) {
    $E = 2;
    $PI = PHP_INT_MAX;
    $generator = (object)[];

    for ($j = 0; $j < 1022; $j++) {
        $prop = 'b'. $j;
        $generator->$prop = PHP_INT_MIN;
    }

    gc_collect_cycles();

    for ($j = 0; $j < 1022; $j++) {
        $prop = 'b'. $j;
        $generator->$prop = PHP_INT_MAX;
    }
}

f(PHP_INT_MAX);

?>
