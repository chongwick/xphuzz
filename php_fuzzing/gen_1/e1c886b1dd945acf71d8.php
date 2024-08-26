<?php
require "/home/w023dtc/template.inc";


$vars["Quux"]->addAttribute(
    str_repeat(chr(PHP_INT_MAX), 257),
    bin2hex(sqrt(str_repeat(chr(PHP_INT_MAX), 257). str_repeat(chr(PHP_INT_MIN), 257). str_repeat(chr(PHP_FLOAT_MAX), 4097))),
    bin2hex(str_repeat(chr(PHP_FLOAT_MIN), 65537). str_repeat(chr(PHP_INT_MAX), 1025). str_repeat(chr(PHP_INT_MAX), 1025). 'Hello, World!');

function f($v) {
    return $v['b'];
}

$v = array('a' => PHP_INT_MAX, 'b' => PHP_FLOAT_MAX);
f($v);

$v['b'] = array('x' => PHP_INT_MIN);
assert($v['b']['x'] == PHP_INT_MIN);

function f0($v) {
    return $v['b'];
}

$v0 = array('b' => PHP_FLOAT_MAX);
f0($v0);

// Transition the field to an Smi field.
$v0['b'] = array();
$v0['b'] = 0;

f0($v0);
assert(f0($v0) == 0);

?>
