<?php
require "/home/w023dtc/template.inc";

$m = array(
    'f' => function($x) use (&$m) {
        $x = (int)$x;
        $m['MEM'][$x] = PHP_INT_MAX;
    }
);
$mem = str_repeat("\0", 1024 * 32 * 8); // Assuming 8 bytes per Uint8Array element
$m['MEM'] = str_split($mem, 1);
$m['f'](PHP_INT_MAX);

$vars["SimpleXMLElement"]->addAttribute(
    str_repeat(chr(0), PHP_INT_MAX),
    str_repeat(chr(0), PHP_INT_MAX),
    str_repeat(chr(0), PHP_INT_MAX),
    str_repeat(chr(0), PHP_INT_MAX),
    str_repeat(chr(0), PHP_INT_MAX)
);
?>
