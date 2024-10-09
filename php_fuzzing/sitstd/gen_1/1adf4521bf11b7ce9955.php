<?php

function foo(array &$a, $b) {
    $a[$b] = 1;
    return $a[$b];
}

$v = [];
$vars = array();
$vars["DOMNode"]->C14N(true, true, array(0, 1, -1, 2, 3, 4, 5, 10, 100, 100000, 5473817451, 123475932, 2.23431234213480e-400), array("a" => "1", "b" => "2", "c" => "3.0", "d" => array(), "e" => null, "f" => new stdClass()));
echo foo($v, 1). "\n"; // Output: 1
$v = [];
$v['__proto__']['__proto__'] = new \ArrayObject();
echo foo($v, 1). "\n"; // Output: 1
echo foo($v, 2). "\n"; // Output: Notice: Undefined index: 2 in - on line

?>
