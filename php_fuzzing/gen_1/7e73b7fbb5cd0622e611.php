<?php
require "/home/w023dtc/template.inc";


function baz($x) {
    return unserialize('O:8:"00000000":');
}

function foo($x) {
    baz($x);
}

foo(PHP_INT_MAX);

?>
