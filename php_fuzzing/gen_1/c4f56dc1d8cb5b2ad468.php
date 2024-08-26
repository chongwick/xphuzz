<?php
require "/home/w023dtc/template.inc";


$a = PHP_INT_MAX;
$b = PHP_INT_MIN;
$c = PHP_FLOAT_MAX;
$d = PHP_FLOAT_MIN;

$vars["DOMImplementation"]->addAttribute(chr($a).chr($b).chr($c).chr($d).sqrt($c).chr(2147483648).str_repeat(chr(65533), 17).dechex($d).chr(3).str_repeat(chr(255), 1025).rand(-100000, 100000).chr(128).bin2hex(str_repeat(chr(16), 4097)).chr(17).chr(1).chr(255).chr(128).chr(3).chr(2).str_repeat(chr(1), 1025));

?>
