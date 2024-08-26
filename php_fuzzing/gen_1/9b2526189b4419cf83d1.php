<?php
require "/home/w023dtc/template.inc";


function f() {
    $a = PHP_INT_MAX;
    $b = $a + PHP_INT_MAX;
    $c = $b + $a;
    var_dump($c);
}

f();

?>
