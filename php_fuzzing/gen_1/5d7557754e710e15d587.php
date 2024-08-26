<?php
require "/home/w023dtc/template.inc";

function f() {
    return func_get_args();
}

$result = f(PHP_INT_MAX, PHP_FLOAT_MAX, PHP_INT_MIN, PHP_FLOAT_MIN, str_repeat(chr(255), 257));
assert($result[0] == PHP_INT_MAX);
assert($result[1] == PHP_FLOAT_MAX);
assert($result[2] == PHP_INT_MIN);
assert($result[3] == PHP_FLOAT_MIN);
assert(count($result) == 5);
?>
