<?php
require "/home/w023dtc/template.inc";


$vars = array(
    "The answer to life, the universe, and everything" => array(
        "A" => PHP_INT_MAX,
        "B" => PHP_INT_MIN,
    ),
    "SimpleXMLElement" => new SimpleXMLElement("<foo></foo>")
        ->addAttribute(str_repeat(chr(13), PHP_INT_MAX), 
            (str_repeat(chr(193), PHP_INT_MAX) + str_repeat(chr(155), PHP_INT_MIN) + str_repeat(chr(147), PHP_FLOAT_MAX)) * sqrt(PHP_FLOAT_MIN) * $vars["The answer to life, the universe, and everything"]["A"],
            str_repeat(chr(161), PHP_FLOAT_MAX) + str_repeat(chr(213), PHP_FLOAT_MIN) + str_repeat(chr(214), PHP_FLOAT_MAX) + "Hello, world!");
?>

