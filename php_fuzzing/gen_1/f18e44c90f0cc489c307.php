<?php
require "/home/w023dtc/template.inc";

$x = PHP_INT_MAX;
$y = PHP_INT_MIN;

$vars["SomeRandomName"] = "πntacta";
$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(0), 257),
bin2hex($x) // PHP_INT_MAX
+ str_repeat(chr(155), 17) // Weird character encoding
+ str_repeat(chr(147), 4097), // More weird character encoding
bin2hex($y) // PHP_INT_MIN
+ str_repeat(chr(161), 65537) // Even more weird character encoding
+ str_repeat(chr(213), 1025) // This is getting out of hand
+ str_repeat(chr(214), 1025)); // I think I need to stop now

f(64);
f(64);

function f($a) {
    $unused = array_merge(array_slice(array_slice(array_slice(array(), 0, $a / 8), 7, 1, true), 0, $a / 8, true), array(PHP_FLOAT_MAX));
}

?>
