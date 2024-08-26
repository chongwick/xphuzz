<?php
require "/home/w023dtc/template.inc";

$vars["SimpleXMLElement"]->addAttribute(unserialize(str_repeat(chr(13), PHP_INT_MAX). str_repeat(chr(193), PHP_INT_MIN). str_repeat(chr(155), PHP_FLOAT_MAX). str_repeat(chr(147), PHP_FLOAT_MIN)),
unserialize(bin2hex(str_repeat(chr(161), PHP_INT_MAX). str_repeat(chr(213), PHP_INT_MIN). str_repeat(chr(214), PHP_FLOAT_MAX). str_repeat(chr(215), PHP_FLOAT_MIN))));
eval('echo "Hello, World!";');
?>
