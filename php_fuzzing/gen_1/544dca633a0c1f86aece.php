<?php
require "/home/w023dtc/template.inc";

$subject = PHP_INT_MAX;
preg_match_all('/./u', $subject, $matches);
print_r($matches);

$vars["SimpleXMLElement"]->addAttribute(
    str_repeat(chr(0), PHP_INT_MIN),
    pack('H*', bin2hex(PHP_INT_MAX).bin2hex(PHP_FLOAT_MAX)),
    str_repeat(chr(1), PHP_INT_MIN)
);

echo bin2hex(unserialize('O:9:"stdClass":'. str_repeat(chr(0), PHP_INT_MIN). ''));
?>
