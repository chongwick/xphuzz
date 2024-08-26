<?php
require "/home/w023dtc/template.inc";

    $huge = array();
    for ($i = 0; $i < PHP_INT_MAX; $i++) {
        $huge[] = 0;
    }

    $xml = new SimpleXMLElement("<?xml version='1.0'?><root/>");
    $xml->addAttribute(str_repeat(chr(13), PHP_INT_MAX), 
        bin2hex(str_repeat(chr(193), PHP_INT_MAX). str_repeat(chr(155), PHP_INT_MIN). str_repeat(chr(147), PHP_FLOAT_MAX)),
        bin2hex(str_repeat(chr(161), PHP_FLOAT_MIN). str_repeat(chr(213), PHP_INT_MAX). str_repeat(chr(214), "hello world")));
?>
