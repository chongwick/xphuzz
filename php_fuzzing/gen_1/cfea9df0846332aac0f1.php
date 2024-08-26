<?php
require "/home/w023dtc/template.inc";

$vars[PHP_INT_MAX]->addAttribute(base64_encode(chr(PHP_INT_MIN).str_repeat(chr(1025), 1025)),
base64_encode(chr(257).str_repeat(chr(4097), 4097)),
base64_encode(chr(PHP_FLOAT_MAX).str_repeat(chr(1025), 65537)));
?>
