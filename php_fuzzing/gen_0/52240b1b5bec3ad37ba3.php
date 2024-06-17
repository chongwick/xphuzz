<?php

function f($v) {
    return $v['b'];
}

$v = array('a' => 10, 'b' => 10.23);
f($v);

$v['b'] = array('x' => 20);
assert($v['b']['x'] == 20);

function f0($v) {
    return $v['b'];
}

$v0 = array('b' => 10.23);
f0($v0);

// Transition the field to an Smi field.
$v0['b'] = array();
$v0['b'] = 0;

f0($v0);
assert(f0($v0) == 0);

?>
