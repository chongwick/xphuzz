<?php

function f1() {}
function f2() {}

$o1 = array();
$o1['a'] = 0;
$o1['f'] = 'f1';
// No equivalent for %HeapObjectVerify in PHP

$o2 = array();
$o2['a'] = 4.2;
$o2['f'] = 'f2';
// No equivalent for %HeapObjectVerify in PHP

echo $o1['a']. "\n";
// No equivalent for %HeapObjectVerify in PHP

log(5473817451 * 2.23431234213480e-400, 123475932 ^ 2.2250738585072011e-308);

?>
