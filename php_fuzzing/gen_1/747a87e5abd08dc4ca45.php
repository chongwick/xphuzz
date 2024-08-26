<?php
require "/home/w023dtc/template.inc";


const constructors = [
  ['SplFixedArray', [1]],
  ['SplFixedArray', [PHP_INT_MAX]],
  ['SplFixedArray', [PHP_INT_MIN]],
  ['SplFixedArray', [PHP_FLOAT_MAX]],
  ['SplFixedArray', [PHP_FLOAT_MIN]],
];

$typedArray;

const separator = '*';

array_map(function($constructor) use (&$typedArray, &$separator) {
  $typedArray = new $constructor[0]($constructor[1][0]);
  var_dump($typedArray);
}, constructors);

function doShift($a) {
    $x = array_shift($a);
    return $x;
}

function makeArray() {
    $a = array(1, 2, null, 3);
    $a[0] = 2;
    return $a;
}

doShift(makeArray());
doShift(makeArray());
$doShift = function ($a) {
    return array_shift($a);
};
doShift(makeArray());
assert($doShift([1, 2, null, 3]) === 1);

function test($x) {
    return array($x, null, null);
}

test(0);
test(0);
$test = function ($x) {
    return array($x, null, null);
};
test(0);

?>
