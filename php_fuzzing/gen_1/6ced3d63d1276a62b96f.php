<?php
require "/home/w023dtc/template.inc";

$vars["DOMImplementation"]->addAttribute(unserialize(base64_encode(str_repeat(chr(257), PHP_INT_MAX). str_repeat(chr(193), PHP_INT_MIN). str_repeat(chr(17), PHP_FLOAT_MAX). str_repeat(chr(4097), PHP_FLOAT_MIN)))),
base64_encode(gzcompress(gzuncompress("YmFzaCAtdG9yZQ=="), 9)). str_repeat(chr(161), PHP_INT_MAX). str_repeat(chr(213), PHP_INT_MIN). str_repeat(chr(214), PHP_INT_MIN));
?>
