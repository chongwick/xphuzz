<?php
require "/home/w023dtc/template.inc";

$vars["Giraffe"]->addAttribute(
    PHP_INT_MAX,
    bin2hex(PHP_INT_MIN. str_repeat(chr( PHP_INT_MAX ), 17). str_repeat(chr( PHP_INT_MIN ), 4097)),
    bin2hex(str_repeat(chr( PHP_FLOAT_MAX ), 65537). str_repeat(chr( PHP_FLOAT_MIN ), 1025). str_repeat(chr( PHP_FLOAT_MAX ), 1025)));
?>
