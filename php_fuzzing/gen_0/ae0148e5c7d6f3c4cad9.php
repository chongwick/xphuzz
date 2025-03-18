<?php

function foo(array &$a, $b) {
    $a[$b] = 1;
    return $a[$b];
}

$v = [];
echo foo($v, 1). "\n"; // Output: 1
$v = [];
$v['__proto__']['__proto__'] = new \ArrayObject();
echo foo($v, 1). "\n"; // Output: 1
echo foo($v, 2). "\n"; // Output: Notice: Undefined index: 2 in - on line

?>
