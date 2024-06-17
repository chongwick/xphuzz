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

$expected = 6.176516726456e-312;
function f() {
    global $double_arr2, $flag;
    swap();
    $double_arr2[0] = 1;
    transition($array);
    $double_arr2[1] = $expected;
}

for ($i = 0; $i < 0x10000; $i++) {
    f();
}
$flag = 1;
f();
echo $expected === $double_arr2[1]? 'assertEquals passed' : 'assertEquals failed';

?>
