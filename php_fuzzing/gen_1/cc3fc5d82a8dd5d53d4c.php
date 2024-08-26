<?php
require "/home/w023dtc/template.inc";


function baz($x) {
    $x = array_fill(0, PHP_INT_MAX, 'anyfunc');
    return $x;
}

function foo($x) {
    baz($x);
}

foo('Hello'); // Passing an argument to foo()
foo('World'); // Passing an argument to foo()
foo('PHP'); // Passing an argument to foo()

?>
