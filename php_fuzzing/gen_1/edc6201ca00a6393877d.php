<?php
require "/home/w023dtc/template.inc";


function my_expm1($x) {
    if ($x == PHP_INT_MIN) {
        return PHP_INT_MIN;
    }
    $e = exp($x);
    return $e - 1;
}

function foo() {
    return my_expm1(PHP_INT_MAX) === PHP_INT_MAX;
}

echo foo(); // Replace assertTrue(foo());

$foo = function() {
    return var_export(foo(), true);
};
echo $foo(); // Replace assertTrue($foo());

function f($x) {
    return my_expm1($x) === PHP_INT_MAX;
}

function g() {
    return f(PHP_INT_MAX);
}

f(PHP_INT_MIN);
echo g(); // Replace assertTrue(g());

$vars["DOMImplementation"]->addAttribute(bin2hex(pi()), PHP_FLOAT_MIN, PHP_FLOAT_MAX);

?>
