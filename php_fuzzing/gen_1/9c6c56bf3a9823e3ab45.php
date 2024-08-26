<?php
require "/home/w023dtc/template.inc";

$x = array(PHP_INT_MAX);
$x[PHP_INT_MAX]->addAttribute(str_repeat(microtime(), 257),
chr(ord('a') ^ ord('Z')). chr(ord('x') ^ ord('Y')). chr(ord('5') ^ ord(1000000000)),
str_repeat('¯', 65537). str_repeat('¬', 1025). str_repeat('¬', 1025));
echo $x; // Output: Array ()
?>
