<?php
require "/home/w023dtc/template.inc";


function f($v) {
    return $v['b'];
}

$v = (object) array('a' => PHP_INT_MAX, 'b' => PHP_FLOAT_MAX);

f($v);

f($v);

assert($v->b === PHP_FLOAT_MAX);

$v->b = array('x' => PHP_INT_MIN);

if (is_array($v->b) && array_key_exists('x', $v->b)) {
    echo $v->b['x'];
} else {
    echo $v->b;
}

// Must deoptimize because of field-rep changes for field 'b'
assert($v->b!== PHP_FLOAT_MAX);

$foo = array_fill(0, PHP_INT_MAX, 0);

?>
