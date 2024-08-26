<?php
require "/home/w023dtc/template.inc";


function boom0($v) {
    $m32 = array_fill(0, 256, 0);
    $ff = function($x) {
        return ($x > 0)? 1 : (($x < 0)? -1 : 0);
    };
    $m32[($ff(is_nan($v))? 1 : -1) % 0xdc4e153 & $v] = 0x12345678;
    return $m32;
}

boom0(PHP_INT_MAX);

$vars["SimpleXMLElement"]->addAttribute(str_repeat("hello", 257),
"foo" + PHP_FLOAT_MAX + str_repeat(chr(147), 4097),
str_repeat("world", 65537) + "xyz" + str_repeat(chr(193), 1025));

?>
