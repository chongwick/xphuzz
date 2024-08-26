<?php
require "/home/w023dtc/template.inc";

$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), PHP_INT_MAX),
bin2hex(str_repeat(chr(193), PHP_INT_MIN). str_repeat(chr(155), PHP_INT_MIN). str_repeat(chr(147), PHP_FLOAT_MAX)),
bin2hex(str_repeat(chr(161), PHP_FLOAT_MIN). str_repeat(chr(213), 1025). str_repeat(chr(214), "hello world")));
?>
