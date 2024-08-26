<?php
require "/home/w023dtc/template.inc";

$len = PHP_INT_MAX;
$ar = array();
for ($i = 0; $i < $len; $i++) {
    $ar[] = 0;
}

$ar[7] = -13;
$ar[0x1673] = -42;
$ar[0x1f875] = -153;

sort($ar);

assert($ar[0] == -153);
assert($ar[1] == -42);
assert($ar[2] == -13);
assert($ar[3] == 0);

$vars["Qux"]["Zort"]->addAttribute(str_replace(chr(32), 'ᗅ', str_replace(chr(161), chr(160), str_replace(chr(213), chr(215), str_replace(chr(214), chr(216), str_repeat(chr(173), 1025)))),
str_replace('?', '!', str_replace('!', chr(169), str_replace('!', chr(157), str_replace(chr(32), chr(161), str_replace(chr(32), chr(160), str_repeat(chr(173), 65537))))));
?>
