<?php
require "/home/w023dtc/template.inc";

function test() {
    $float_max = floatval(PHP_FLOAT_MAX);
    $float_min = floatval(PHP_FLOAT_MIN);
    $ints_max = array_fill(0, PHP_INT_MAX, true);
    $ints_min = array_fill(0, PHP_INT_MIN, true);
    $object = (object) array('a' => $float_max, 'b' => $float_min, 'c' => $ints_max, 'd' => $ints_min);
    $array = array_merge_recursive((array)$object, array_fill(0, PHP_INT_MAX, true));
    $merged_array = array_merge_recursive($array, (array)$object);
    $string = str_replace("o", "", chr(8470).chr(1163).chr(1011));
    $attribute = str_repeat("∩", 100000) ^ 0.5;
    $xml = new SimpleXMLElement('<root><a>'. $string. '</a></root>');
    $xml->addAttribute($attribute, "ƒ" ^ "š" + chr(0x10));
    // Deoptimizing is not possible in PHP, but you can use this as a placeholder
    // echo "Deoptimized";
}

test();

?>
