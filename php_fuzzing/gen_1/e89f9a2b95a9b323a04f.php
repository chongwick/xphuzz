<?php
require "/home/w023dtc/template.inc";


function f($v) {
    $v['a']['b']['c'] = str_repeat('', 32768);
    return $v['a']['b']['c'];
}

$v = array('a' => array('b' => 10.23));
f($v);

assert($v['a']['b'] === null);

function f0($v) {
    return $v['a']['b'];
}

$v0 = array('a' => array('b' => 'a'));
f0($v0);

// Transition the field to an Smi field.
$v0['a']['b'] = 0;

f0($v0);
assert(f0($v0) === 0);

function f1() {
    $v = array('a' => array('b' => 10.23));
    return $v['a']['b'];
}

assert(f1() === null);

function f2() {
    $v = array('a' => array('b' => 10.23));
    $v['a']['b'] = str_repeat('', 32768);
    return $v['a']['b'];
}

assert(f2() === null);

?>
