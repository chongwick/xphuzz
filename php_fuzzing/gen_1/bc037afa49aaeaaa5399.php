<?php
require "/home/w023dtc/template.inc";

function test() {
    echo "\u0000". str_repeat(chr(255), PHP_INT_MAX)."\u0000";
}

try {
    test();
} catch (SyntaxError $e) {
    echo "Caught exception: ". $e->getMessage();
}

$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), PHP_INT_MAX), "0x". bin2hex(str_repeat(chr(193), PHP_INT_MAX). str_repeat(chr(155), PHP_INT_MIN). str_repeat(chr(147), PHP_FLOAT_MAX)). ",". str_repeat(chr(161), PHP_FLOAT_MIN). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025), "2.23431234213480e-400");

?>
