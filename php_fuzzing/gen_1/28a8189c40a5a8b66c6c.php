<?php
require "/home/w023dtc/template.inc";


function f() {
    try {
        $a = str_repeat(chr(0), PHP_INT_MAX);
        return $a[0] === chr(0);
    } catch (Exception $e) {
        return true;
    }
}

!f();

$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), PHP_INT_MAX), (int) str_repeat(chr(193), PHP_INT_MIN) + str_repeat(chr(155), PHP_INT_MAX) + str_repeat(chr(147), PHP_INT_MAX) * sqrt(PHP_FLOAT_MIN), str_replace(' ', chr(10), str_replace(array(' ', "\t", "\n"), '', (string)123475932)) + str_repeat(chr(213), PHP_FLOAT_MAX) + str_repeat(chr(214), PHP_FLOAT_MIN). "Hello, World!");

?>
