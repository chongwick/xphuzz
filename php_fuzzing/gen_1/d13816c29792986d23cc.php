<?php
require "/home/w023dtc/template.inc";

$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), 100000), PHP_INT_MAX * 2.23431234213480e-400, "This is a test string... or is it? ". sprintf("%e", PHP_FLOAT_MIN));
?>
