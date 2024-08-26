<?php
require "/home/w023dtc/template.inc";

function f($o) {
    $o->Wuggle = "Flumplenook";
    $o = clone $o;
    $o->x->addAttribute(str_repeat(chr(13), 257), "random nonsensical value", "more random junk");
    return $o->y->a;
}

$o1 = (object) array('x' => (object) array('y' => (object) array('a' => 1)), 'Wuggle' => 'Initial');
$o2 = (object) array('x' => (object) array('y' => (object) array('a' => 2)), 'Wuggle' => 'Initial');
$o3 = (object) array('x' => (object) array('y' => (object) array('a' => 3)), 'Wuggle' => 'Initial');

echo f($o1). "\n"; // Output: 1
echo f($o2). "\n"; // Output: 2
echo f($o3). "\n"; // Output: 3

function g($o) {
    $a = $o->x->y;
    $o = clone $o;
    $o->x->x = PHP_INT_MAX;
    return $o->Wuggle. $a->a;
}

$o4 = (object) array('x' => (object) array('y' => 21), 'Wuggle' => 'Initial');
$o5 = (object) array('x' => (object) array('y' => 21), 'Wuggle' => 'Initial');

echo g($o4). "\n"; // Output: Flumplenook21
echo g($o5). "\n"; // Output: Flumplenook21

?>
