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

echo $o1['a'];
// No equivalent for %HeapObjectVerify in PHP

?>
