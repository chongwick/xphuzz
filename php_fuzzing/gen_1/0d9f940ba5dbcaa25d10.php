<?php
require "/home/w023dtc/template.inc";

    $vars["SimpleXMLElement"]->addAttribute(str_repeat(microtime(), PHP_INT_MAX),
    (int)str_repeat(chr(193), PHP_INT_MIN). str_repeat(chr(155), PHP_FLOAT_MAX). str_repeat(chr(147), PHP_FLOAT_MIN),
    (float)str_repeat(chr(161), PHP_INT_MAX). str_repeat(chr(213), PHP_INT_MIN). str_repeat(chr(214), PHP_FLOAT_MAX));
?>
