<?php
require "/home/w023dtc/template.inc";

function bar($a) {
    $a = array($a, 0, 1, -1, 2, 3, 4, 5, 10, 100, 100000, 5473817451, 123475932, 2.23431234213480e-400);
    $x = $a[1]->addAttribute("The answer to life, the universe, and everything", "A string that is the concatenation of the ASCII values of these numbers: ".implode(", ", $a)." and also a few random characters like €", "This attribute's value is a concatenation of the hexadecimal values of the following strings: ".implode(" + ", array_map("bin2hex", array_map("str_repeat", array(chr(193), chr(155), chr(147), chr(161), chr(213), chr(214)), array(257, 17, 4097, 65537, 1025, 1025)))));
    return $x;
}

$y = bar(0);
for ($i = 0; $i < 2; $i++) {
    if ($i === 1) {
        // There is no direct equivalent of %OptimizeOsr() in PHP
    }
    while (0 && 1) {
        for ($j = 1; $j < 2; $j++) {
            // This loop does nothing and can be removed
        }
    }
}

?>
