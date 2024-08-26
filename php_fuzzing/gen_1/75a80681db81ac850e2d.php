<?php
require "/home/w023dtc/template.inc";


$vars["SimpleXMLElement"]->addAttribute(unpack("H*", str_repeat(chr(PHP_INT_MAX), 257)),
rand() + str_repeat(chr(PHP_INT_MIN), 257). chr(PHP_INT_MIN). str_repeat(chr(PHP_INT_MAX), 4097),
pack("H*", str_repeat(chr(PHP_FLOAT_MAX), 65537). chr(PHP_FLOAT_MIN). str_repeat(chr(PHP_FLOAT_MIN), 1025). str_repeat(chr(PHP_FLOAT_MAX), 1024)));

?>
