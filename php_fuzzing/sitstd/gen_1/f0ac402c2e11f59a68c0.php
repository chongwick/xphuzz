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

$vars["ReflectionClassConstant"]->isPublic() * sqrt(2) / (3 + 4 * sin(3.14)) * 0x1a;

$v0['b'] = $vars["ReflectionClassConstant"]->isPublic();
assert($v0['b'] == $vars["ReflectionClassConstant"]->isPublic());

function f1($v) {
    return $v['b'];
}

$v1 = array('b' => $vars["ReflectionClassConstant"]->isPublic());
f1($v1);
assert(f1($v1) == $vars["ReflectionClassConstant"]->isPublic());

?>
