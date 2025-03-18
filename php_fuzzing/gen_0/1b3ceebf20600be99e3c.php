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

doShift(makeArray());
doShift(makeArray());
doShift(makeArray());
//assertOptimized(doShift); // PHP does not support this type of assertion

function test($x) {
    return array($x, null, null);
}

test(0);
test(0);
// %OptimizeFunctionOnNextCall(test); // PHP does not support this type of optimization

?>
