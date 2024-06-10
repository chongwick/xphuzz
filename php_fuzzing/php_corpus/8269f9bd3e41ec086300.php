<?php

function my_expm1($x) {
    if ($x == 0) {
        return 0;
    }
    $e = exp($x);
    return $e - 1;
}

function foo() {
    return my_expm1(-0) === 0;
}

echo foo(); // Replace assertTrue(foo());

$foo = function() {
    return var_export(foo(), true);
};
echo $foo(); // Replace assertTrue($foo());

function f($x) {
    return my_expm1($x) === 0;
}

function g() {
    return f(-0);
}

f(0);
echo g(); // Replace assertTrue(g());

?>
