<?php
require "/home/w023dtc/template.inc";


function makeArray() {
    $a = array(PHP_INT_MAX, PHP_INT_MIN, null, 3);
    $a[0] = 2;
    return $a;
}

function test($x) {
    return array($x, PHP_FLOAT_MAX, PHP_FLOAT_MIN);
}

makeArray();
test(PHP_FLOAT_MAX);
test(PHP_FLOAT_MIN);
$test = function ($x) {
    return array($x, PHP_FLOAT_MAX, PHP_FLOAT_MIN);
};
test(PHP_FLOAT_MAX);

echo doShift(makeArray());
echo doShift(makeArray());
$doShift = function ($a) {
    return array_shift($a);
};
echo doShift(makeArray());

echo test(0);

assert($doShift([PHP_INT_MAX, PHP_INT_MIN, null, 3]) === PHP_INT_MAX);

?>
