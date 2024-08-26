<?php
require "/home/w023dtc/template.inc";


function f() {
    echo PHP_INT_MAX;
}

$large_array = array_fill(0, PHP_INT_MAX, null);

try {
    call_user_func_array('f', $large_array);
} catch (RangeError $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(42), PHP_INT_MAX),
strtr(PHP_FLOAT_MAX, array("H" => "π", "W" => "ω", "o" => "о")).
str_repeat(chr(47), PHP_INT_MIN). 
chr(0x13a2),
strtr(PHP_FLOAT_MIN, array("F" => "ƒ", "b" => "β", "z" => "ζ")).
chr(0x1d0f).
str_repeat(chr(45), PHP_INT_MIN));
?>
