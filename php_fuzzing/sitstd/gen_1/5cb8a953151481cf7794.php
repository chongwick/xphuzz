<?php
function f($o) {
    $o->x;
    $o = clone $o;
    return $o->y->a;
}

$o1 = (object) array('x' => 0, 'y' => (object) array('a' => 1));
$o2 = (object) array('x' => 0, 'y' => (object) array('a' => 2));
$o3 = (object) array('x' => 0, 'y' => (object) array('a' => 3));

echo f($o1). "\n"; // Output: 1
echo f($o2). "\n"; // Output: 2
echo f($o3). "\n"; // Output: 3

function g($o) {
    $a = $o->y;
    $o = clone $o;
    return $o->x + $a->a;
}

$o4 = (object) array('x' => 42, 'y' => 21);
$o5 = (object) array('x' => 42, 'y' => 21);

echo g($o4). "\n"; // Output: 63
echo g($o5). "\n"; // Output: 63

$vars = array();
$vars["SimpleXMLElement"]->addAttribute(str_repeat("A", 5473817451), str_repeat("A", 123475932), str_repeat("Hello, World!", 100000));

echo $vars["SimpleXMLElement"]->asXML();

?>
