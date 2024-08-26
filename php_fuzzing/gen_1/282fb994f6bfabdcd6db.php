<?php
require "/home/w023dtc/template.inc";


function gc() {
    for ($i = 0; $i < 20; $i++) {
        $a = str_repeat("\0", PHP_INT_MAX);
    }
}

function trigger() {
    class MyGenerator {
    }

    $generator = new stdClass();

    for ($i = 0; $i < PHP_INT_MAX; $i++) {
        $prop = 'b'. $i;
        $generator->$prop = 0x1234;
    }

    gc();

    for ($i = 0; $i < PHP_INT_MAX; $i++) {
        $prop = 'b'. $i;
        $generator->$prop = 0x1234;
    }
}

trigger();

$simpleXMLElement = new SimpleXMLElement('<root/>');

for ($i = 0; $i < PHP_FLOAT_MAX; $i++) {
    $simpleXMLElement->addAttribute(str_repeat(chr(13), 257). "π", str_repeat(chr(193), 257) + str_repeat(chr(155), 17) + str_repeat(chr(147), 4097)^2.23431234213480e-400, "a" ^ str_repeat(chr(161), 65537). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025));
}

echo $simpleXMLElement->asXML();

?>
