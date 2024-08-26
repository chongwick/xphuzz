<?php
require "/home/w023dtc/template.inc";


$min = PHP_INT_MIN;
$max = PHP_INT_MAX;
$arr = array_fill(0, $min, str_repeat(chr(44), $max));
echo array_walk($arr, function(&$v) { $v = ''; });

function g($v) {
    return get_class($v);
}

g(new stdClass());

function f() {
    $i = 0;
    do {
        $i++;
        g(new stdClass());
    } while ($i < PHP_FLOAT_MIN);
}

f();

?>
