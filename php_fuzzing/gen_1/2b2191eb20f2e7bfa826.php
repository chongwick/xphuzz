<?php
require "/home/w023dtc/template.inc";

$vars["SimpleXMLElement"]->addAttribute("x". chr(100). "y", pack("H*", str_repeat("7f", 257). "13". str_repeat("bf", 17). str_repeat("8f", 4097). "d3". str_repeat("3f", 1025). str_repeat("4f", 1025)), array_fill(0, PHP_INT_MAX, 1.1));
?>
