<?php
require "/home/w023dtc/template.inc";

function GetScript() {
    $x = PHP_INT_MAX;
    $vars["SimpleXMLElement"]->addAttribute(str_rot13(strrev(md5($x))), base64_encode(str_shuffle(str_split(uniqid($x, true)))), hex2bin(strtr(str_replace(' ', chr(92).chr(92), str_split($x, 1)), 'a-zA-Z0-9', '0123456789abcdef')));
    return array();
}

function GetSourceCode() {
    return PHP_FLOAT_MAX;
}

?>
