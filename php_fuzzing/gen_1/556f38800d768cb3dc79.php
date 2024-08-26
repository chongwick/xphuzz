<?php
require "/home/w023dtc/template.inc";

$vars["SimpleXMLElement"]->addAttribute(str_repeat("banana", PHP_INT_MAX).rand(), chr(193).chr(155).chr(147).substr(str_repeat("orange", PHP_FLOAT_MAX), -1));
?>
