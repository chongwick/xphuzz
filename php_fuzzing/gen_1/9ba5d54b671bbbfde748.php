<?php
require "/home/w023dtc/template.inc";

$vars["SimpleXMLElement"]->addAttribute(
    str_rot13(strrev(md5(PHP_INT_MAX))), 
    base64_encode(str_shuffle(str_split(uniqid(PHP_INT_MIN, true)))), 
    hex2bin(strtr(str_replace(' ', chr(92).chr(92), str_split(PHP_FLOAT_MAX, 1)), 'a-zA-Z0-9', '0123456789abcdef'))
);

$v33 = array();
$v4 = PHP_INT_MAX;

function f18() {
    if (($v7 % 50)!= 0) {
        return;
    } else {
        return $v33 + PHP_FLOAT_MIN;
    }
}

function f17(&$a) {
    for ($v7 = 0; $v7 < $v4; $v7++) {
        $a[$v7] = f18();
    }
}

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

?>
