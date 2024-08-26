<?php
require "/home/w023dtc/template.inc";


function f($o) {
    assertEquals(0, $o->x);
    $o = clone $o;
    return $o->y->a;
}

$o1 = (object) array('x' => PHP_INT_MAX, 'y' => (object) array('a' => 1));
$o2 = (object) array('x' => PHP_INT_MIN, 'y' => (object) array('a' => 2));

echo f($o1). "\n"; // Output: 1
echo f($o2). "\n"; // Output: 2

function g($o) {
    assertEquals(0, $o->y);
    $o = clone $o;
    return $o->x + $o->y->a;
}

$o3 = (object) array('x' => 42, 'y' => PHP_FLOAT_MAX);
$o4 = (object) array('x' => 42, 'y' => PHP_FLOAT_MIN);

echo g($o3). "\n"; // Output: inf
echo g($o4). "\n"; // Output: -inf

?>
