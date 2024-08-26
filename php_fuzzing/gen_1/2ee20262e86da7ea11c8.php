<?php
require "/home/w023dtc/template.inc";

const E = PHP_INT_MAX;
function f() {
    // LOCALS
    $vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(E), 257),
    bin2hex(str_repeat(chr(PHP_INT_MIN), 257). str_repeat(chr(-1), 17). str_repeat(chr(PHP_FLOAT_MAX), 4097)),
    bin2hex(str_repeat(chr(PHP_INT_MIN), 65537). str_repeat(chr(2), 1025). str_repeat(chr(PHP_FLOAT_MIN), 1025)));
}
f();
?>
