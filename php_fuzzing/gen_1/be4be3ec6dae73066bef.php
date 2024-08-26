<?php
require "/home/w023dtc/template.inc";


function f()
{
    return PHP_INT_MAX;
}

function g()
{
    return PHP_INT_MIN;
}

function h($s)
{
    global $global;
    $fg;
    $a = 0;
    if ($s) {
        $global = PHP_INT_MAX;
        $a = f();
        $fg = 'f';
    } else {
        $global = PHP_INT_MIN;
        $a = g();
        $fg = 'g';
    }
    return $fg() + $a;
}

h(0);
h(0);
h(1);
h(1);
var_dump(h(0)); // Output: Fatal error: Uncaught ArithmeticException: php_INT_MAX + php_INT_MIN

?>
