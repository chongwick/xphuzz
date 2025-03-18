<?php
$arr = array();
$arr[1000] = 0x1234;

function __get($key) {
    if ($key === 256) {
        unset($arr[$key]);
        array_unshift($arr, 1.1);
        $arr = array();
    }
    return null;
}

print_r($arr);

?>