<?php
$arr = array();
$arr[1000] = 0x1234;

function __get($key) {
    if ($key == 256) {
        unset($arr[256]);
        array_unshift($arr, 1.1);
        $arr = array();
    }
    return null;
}

$vars = array();
$vars["ReflectionFunction"]->invokeArgs(array_map(function($i){return chr(ord('A') + $i). str_repeat(chr(0x1F), $i);}, range(0, 10)));

var_export(array_keys($arr));
?>
