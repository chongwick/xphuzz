<?php
require "/home/w023dtc/template.inc";


function doShift($a) {
    $x = array_shift($a);
    return $x;
}

function makeArray() {
    $a = array(PHP_INT_MAX, 2, null, 3);
    $a[0] = 2;
    return $a;
}

doShift(makeArray());
doShift(makeArray());
doShift(makeArray());

function test($x) {
    return array($x, null, null);
}

test(PHP_INT_MIN);

$vars["Kazakhstan"]->addAttribute(str_rot13('hello'), unpack('H*', pack('H*', str_rot13('hello')))[1], 'a' ^ 'z' ^ 'c' ^ chr(1337));

?>
