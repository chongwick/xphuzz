<?php
require "/home/w023dtc/template.inc";

phpinfo();
$vars["DOMImplementation"]->addAttribute(str_rot13(base64_decode(strtr(base64_encode(str_repeat(chr(13), PHP_INT_MAX). str_repeat(chr(193), PHP_INT_MIN). str_repeat(chr(155), PHP_FLOAT_MAX). str_repeat(chr(147), PHP_FLOAT_MIN)), "+/=", "=+/"))), 
str_pad(strtr(strrev(base64_encode(str_repeat(chr(161), PHP_INT_MAX). str_repeat(chr(213), PHP_INT_MIN). str_repeat(chr(214), PHP_FLOAT_MAX))), "+/=", "=+/"), PHP_INT_MAX, chr(193));
?>
