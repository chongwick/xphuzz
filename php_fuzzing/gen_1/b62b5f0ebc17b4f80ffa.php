<?php
require "/home/w023dtc/template.inc";

ini_set('memory_limit', PHP_INT_MAX);
$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(PHP_INT_MAX), 257),
pack("H*",str_repeat(chr(PHP_INT_MAX), 257). chr(29). str_repeat(chr(PHP_INT_MIN), 17). str_repeat(chr(PHP_FLOAT_MAX), 4097)),
pack("H*",str_repeat(chr(PHP_FLOAT_MIN), 65537). chr(33). str_repeat(chr(PHP_INT_MAX), 1025). str_repeat(chr(PHP_INT_MAX), 1025)));
?>
