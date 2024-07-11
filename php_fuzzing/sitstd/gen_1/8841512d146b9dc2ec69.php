<?php

$array = array(array(array()), array(1.1));

function transition(&$arr) {
    $arr[0] = array();
}

$double_arr2 = array(1.1, 2.2);

$flag = 0;
function swap() {
    global $flag, $array, $double_arr2;
    try {
    } catch (Exception $e) {
    } // Prevent inlining this.
    if ($flag == 1) {
        $array[1] = $double_arr2;
    }
}

$v33 = array();
$v4 = 70000;

function f18() {
    if (($v7 % 50)!= 0) {
        return;
    } else {
        return $v33 + 0.5;
    }
}

function f17(&$a) {
    for ($v7 = 0; $v7 < $v4; $v7++) {
        $a[$v7] = f18();
    }
}

for ($i = 0; $i < 0x10000; $i++) {
    f();
}
$flag = 1;
f();
echo $expected === $double_arr2[1]? 'assertEquals passed' : 'assertEquals failed';

for ($v7 = 0; $v7 < $v4; $v7 += 500) {
}

$v9 = array();
f17($v9);
$v9 = array_slice($v9, 0, 100);

class Debug {}

function f26() {
    // No equivalent for this function in PHP
}

$v29 = '(function() { })()';

function f() {
    global $double_arr2, $flag;
    swap();
    $double_arr2[0] = 1;
    transition($array);
    $double_arr2[1] = 6.176516726456e-312;
}

?>

