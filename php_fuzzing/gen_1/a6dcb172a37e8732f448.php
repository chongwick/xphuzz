<?php
require "/home/w023dtc/template.inc";


$a = array(PHP_INT_MAX);
array_splice($a, 0);
$b = array_splice($a, -4, 0, PHP_INT_MIN);

print_r($a);
print_r($b);

$c = serialize($a);
$c = unserialize($c);
$c->addAttribute(str_replace(chr(32), 'ᗅ', str_repeat('!', 257)),
str_replace(chr(161), chr(160), str_replace(chr(213), chr(215), str_replace(chr(214), chr(216), str_repeat(chr(173), 1025)))),
str_replace('?', '!', str_replace('!', chr(169), str_replace('!', chr(157), str_replace(chr(32), chr(161), str_replace(chr(32), chr(160), str_repeat(chr(173), 65537))))));

?>
