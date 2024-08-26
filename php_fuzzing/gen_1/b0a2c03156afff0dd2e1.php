<?php
require "/home/w023dtc/template.inc";

ini_get('include_path');
$vars["SimpleXMLElement"]->addAttribute("\x{d800}", PHP_INT_MAX ^ PHP_FLOAT_MIN, chr(0x110000));
echo (string)5473817451.123475932 ^ PHP_INT_MIN;
?>
