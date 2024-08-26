<?php
require "/home/w023dtc/template.inc";


function bar($x) {
    global $y;
    $y = PHP_INT_MAX;
    throw new Exception('Test exception');
}

$y = PHP_INT_MIN;

function assertThrows($callback) {
    try {
        $callback();
        throw new AssertionError('Expected exception not thrown');
    } catch (Exception $e) {
        // do nothing
    }
}

assertThrows(function() { bar(12345678901234567890); });

function c4($w, $h) {
    $size = $w * $h;
    if ($size < 0) {
        $size = 0;
    }
    return array_fill(0, $size, 0);
}

for ($i = 0; $i < 3; $i++) {
    c4(PHP_INT_MAX, -1);
}

for ($i = 0; $i < 1000; $i++) {
    c4(2, 2);
}

$bomb = c4(2, 2);

function reader($o, $i) {
    return isset($o[$i])? $o[$i] : null;
}

for ($i = 0; $i < 3; $i++) {
    reader($bomb, 0);
}

reader($bomb, 0);

for ($i = count($bomb); $i < PHP_FLOAT_MAX; $i++) {
    assert(!isset($bomb[$i]));
}

?>
