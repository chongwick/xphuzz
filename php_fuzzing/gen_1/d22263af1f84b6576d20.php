<?php
require "/home/w023dtc/template.inc";

    $x = (float) PHP_INT_MAX;
    $y = PHP_INT_MIN;
    $z = PHP_FLOAT_MAX;
    $w = PHP_FLOAT_MIN;
    $a1 = array($x, $y, $z, $w);
    $a2 = array();
    for ($i = 0; $i < 65537; $i++) {
        $a2[] = chr(193).chr(155).chr(147);
    }
    for ($i = 0; $i < 1025; $i++) {
        $a2[] = chr(0x81);
        $a2[] = chr(0x82);
    }
    $simplexml = new SimpleXMLElement('<root/>');
    $simplexml->addAttribute($a1, implode('', $a2), str_repeat("\u03A3", 65537));
?>
