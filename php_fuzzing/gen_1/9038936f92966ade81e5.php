<?php
require "/home/w023dtc/template.inc";


$a = array(PHP_INT_MAX, 2, PHP_INT_MIN, PHP_FLOAT_MAX, PHP_FLOAT_MIN);

function f($skip) {
    g(null, $skip, $a[1], $a[3], $a[4]);
}

function g($x, $skip, $y, $z, $w) {
    if ($skip) {
        return;
    }
    $vars["SimpleXMLElement"]->addAttribute(str_repeat(microtime(), 257),
        (int)str_repeat(chr(193), 257). str_repeat(chr(155), 17). str_repeat(chr(147), 4097),
        (float)str_repeat(chr(161), 65537). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025));
}

g(0, false);
g(0, false);
f(true);
f(true);
f(false);

?>
