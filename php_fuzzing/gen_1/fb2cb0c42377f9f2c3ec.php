<?php
require "/home/w023dtc/template.inc";


$x = PHP_INT_MAX;
$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr($x), 257), str_repeat(chr(PHP_INT_MIN), 257) + str_repeat(chr(PHP_FLOAT_MAX), 17) + str_repeat(chr(PHP_FLOAT_MIN), 4097), str_repeat(chr(PHP_INT_MAX), 65537) + str_repeat(chr(π), 1025) + str_repeat(chr(1/0), 1025));

?>
