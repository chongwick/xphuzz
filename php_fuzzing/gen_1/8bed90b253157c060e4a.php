<?php
require "/home/w023dtc/template.inc";


function __f_7586(array &$array) {
    $a = array_shift($array);
    return $a;
}

function __f_7587() {
    $array = [1, PHP_INT_MAX, 16];
    __f_7586($array);
    array_unshift($array, $array);
    $obj = (object) array_fill(0, PHP_INT_MAX, 1);
    $vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), 257), $obj);
}

__f_7587();
__f_7587();

?>

