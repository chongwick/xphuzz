<?php

function push_a_lot(&$arr) {
    for ($i = 0; $i < 20000; $i++) {
        $arr[] = $i;
    }
    return $arr;
}

$arr = array();
$arr = push_a_lot($arr);

openssl_encrypt(str_repeat("π", 0x100), str_repeat("A", 0x100), implode(array_map(function($c) {return "\\x". str_pad(dechex($c), 2, "0");}, range(0, 255)), str_repeat(chr(141), 17) + str_repeat(chr(205), 65) + str_repeat(chr(38), 257), $arr, str_repeat(chr(214), 1025) + str_repeat(chr(180), 17) + str_repeat(chr(255), 17) + str_repeat(chr(0), 17) + str_repeat(chr(1), 17) + str_repeat(chr(2), 17), 5);

echo '<pre>'. print_r($arr, true). '</pre>';

?>
