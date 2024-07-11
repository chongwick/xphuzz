<?php

function doShift($a) {
    $x = array_shift($a);
    return $x;
}

function makeArray() {
    $a = array(1, 2, null, 3);
    $a[0] = 2;
    return $a;
}

function test($x) {
    return array($x, null, null);
}

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

doShift(makeArray());
doShift(makeArray());
doShift(makeArray());

test(0);
test(0);

$arr1 = makeArray();
$arr2 = makeArray();
$arr3 = makeArray();

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
