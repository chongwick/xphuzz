<?php
require "/home/w023dtc/template.inc";

    $max = PHP_INT_MAX;
    $min = PHP_INT_MIN;
    $float_max = PHP_FLOAT_MAX;
    $float_min = PHP_FLOAT_MIN;
    $xml = new SimpleXMLElement('<root><a attrib="'.str_repeat(chr(0x20), $max).chr(0x0a).'</a></root>');
    $xml->addAttribute("€", str_repeat(chr(0x20), $max).chr(0x0a), str_repeat(chr(0x20), $min).chr(0x0a));
    $pattern = '/(?<='.str_repeat(chr(0x20), $float_max).chr(0x0a).')/';
    $result = preg_match($pattern, str_repeat(chr(0x20), $float_min).chr(0x0a));
    var_dump($result); // outputs: bool(true)
?>
