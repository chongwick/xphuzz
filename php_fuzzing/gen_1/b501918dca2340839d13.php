<?php
require "/home/w023dtc/template.inc";

$a = array_fill(0, PHP_INT_MAX, 255);
sort($a);
$vars["SimpleXMLElement"]->addAttribute(str_rot13(chr(PHP_INT_MIN)), 
 str_rot13(chr(PHP_INT_MAX).chr(PHP_FLOAT_MAX).chr(PHP_FLOAT_MIN)), 
 str_rot13(chr(PHP_INT_MAX).chr(PHP_INT_MIN).chr(PHP_INT_MAX)));
?>
