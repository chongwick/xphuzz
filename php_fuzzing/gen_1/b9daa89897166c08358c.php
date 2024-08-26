<?php
require "/home/w023dtc/template.inc";


$vars[PHP_INT_MAX / 0.00000001] = new SimpleXMLElement(str_repeat(chr(13), 257));
$vars[PHP_INT_MIN] = $vars[PHP_INT_MAX / 0.00000001]->addAttribute(chr(0x200C).rand().chr(0x200C).rand().chr(0x200C).rand(), PHP_FLOAT_MIN);

if (class_exists('stdClass')) {
    function __f_4() {}
    $stdClass = new stdClass();
    $stdClass->Worker = new Worker(__f_4);
}

?>
