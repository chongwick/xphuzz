<?php
require "/home/w023dtc/template.inc";


function foo() {
    $arr = array();
    return array_pop($arr);
}

assert(foo() === null);
assert(foo() === null);
assert(foo() === null);

echo PHP_INT_MAX ^ PHP_INT_MIN ^ PHP_FLOAT_MAX ^ PHP_FLOAT_MIN;

?>
