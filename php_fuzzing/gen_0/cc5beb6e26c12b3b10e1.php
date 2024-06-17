<?php

function f(array &$a) {
    $a[1] = 0;
}

function foo() {}

$arr1 = array(0);
$arr2 = array(0);
$arr3 = array(0);

$arr1['f'] = 'foo';
$arr1[0] = 4.2;

$arr2['f'] = 'foo';

$arr3['f'] = 'foo';
$arr3[0] = 4.2;
$arr3['f'] = 'f';

f($arr1);
f($arr2);
f($arr3);
f($arr3);

?>
