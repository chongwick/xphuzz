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

var_export(array_keys($arr));
?>
