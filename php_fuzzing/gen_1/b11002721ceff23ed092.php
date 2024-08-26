<?php
require "/home/w023dtc/template.inc";


$a = PHP_INT_MAX;
$b = PHP_INT_MIN;
$c = PHP_FLOAT_MAX;
$d = PHP_FLOAT_MIN;
$x = array_fill(0, $a, $b);
$y = array_fill(0, $c, $d);

function foo() {
    global $x, $y;
    return array_pop($y);
}

assert(foo() === null);
assert(foo() === null);
assert(foo() === null);

?>
