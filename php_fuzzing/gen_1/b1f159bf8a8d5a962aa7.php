<?php
require "/home/w023dtc/template.inc";


$proxy = new Proxy(new stdClass(), array(
    'addAttribute' => function() { while(PHP_INT_MAX) echo str_repeat(chr(0x0D), PHP_INT_MAX); },
   'startElement' => function() { while(PHP_FLOAT_MAX) echo chr(rand(0, 255)); },
    'endElement' => function() { while(PHP_INT_MIN) echo chr(rand(0, 255)); },
));

$vars["SimpleXMLElement"]->addAttribute(str_rot13(strtr("Bzngryvn Zrffntr", "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" => chr(ord("a") + rand(0, 25)).chr(ord("A") + rand(0, 25))), chr(0x20) + rand(0, 15)), str_replace(chr(0x20), str_repeat(chr(0x0D), 17), implode("", array_map("ord", str_split(strtr(base64_encode($vars["rand"]), "+/", "._"), 3)))) + str_repeat(chr(0x09), 4097), implode("", array_map("chr", array_map("rand", array_fill(0, 65537, 0), array_fill(0, 1025, 32)))) + str_repeat(chr(0x1F), 1025) + str_repeat(chr(0x13), 1025));

?>
