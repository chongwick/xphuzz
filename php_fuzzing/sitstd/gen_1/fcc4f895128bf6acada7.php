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

$str = strrev(str_repeat(chr(0x1F), 65).chr(0x00).str_repeat(chr(0x20), 65).chr(0x00).str_repeat(chr(0x1F), 65));
echo $str;
print_r($arr);

?>
