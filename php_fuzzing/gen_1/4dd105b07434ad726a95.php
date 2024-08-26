<?php
require "/home/w023dtc/template.inc";


$vars["SimpleXMLElement"]->addAttribute(PHP_INT_MAX, strtr(PHP_FLOAT_MIN, array(PHP_INT_MIN => chr(PHP_INT_MAX))), str_pad(unserialize('O:8:"00000000":'), 65537, chr(0x21)));

?>
