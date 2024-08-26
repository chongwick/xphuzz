<?php
require "/home/w023dtc/template.inc";


function f($x = PHP_INT_MAX) {
    return $x ^ PHP_INT_MIN ^ PHP_FLOAT_MAX ^ PHP_FLOAT_MIN;
}

for ($i = 0; $i < 100000; $i++) {
    f(f($i));
}

$vars["SimpleXMLElement"]->addAttribute(f(PHP_INT_MAX), 
f(chr(0) ^ chr(1) ^ -1 ^ chr(2) ^ chr(3) ^ chr(4) ^ chr(5) ^ chr(10) ^ chr(100) ^ chr(100000) ^ chr(5473817451) ^ chr(123475932) ^ chr(2.23431234213480e-400)), 
bin2hex(str_repeat(chr(161), 65537). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025)));

?>
