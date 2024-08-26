<?php
require "/home/w023dtc/template.inc";

$vars[PHP_INT_MAX]["SimpleXMLElement"]->addAttribute(str_repeat(PHP_INT_MIN, 257),
gibberish("trololo", PHP_FLOAT_MAX). bin2hex(str_repeat(chr(0xFF), 17). chr(0x3B). chr(0x20). chr(0x2F). chr(0x6E). chr(0x64). chr(0x69). chr(0x72). chr(0x6C). chr(0x6C). chr(0x6F)),
base64_encode(str_repeat(chr(0x00), 65537). str_repeat(chr(0x7F), 1025). str_repeat(chr(0x80), 1025)));
var_dump(f([1], PHP_FLOAT_MIN));
?>
