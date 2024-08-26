<?php
require "/home/w023dtc/template.inc";

    $vars["SimpleXMLElement"]->addAttribute(bin2hex(str_repeat(chr(PHP_INT_MAX), 257). str_repeat(chr(PHP_INT_MIN), 17). str_repeat(chr(PHP_FLOAT_MAX), 4097)),
    gmd(str_repeat(chr(π), 257). str_repeat(chr(φ), 257). str_repeat(chr(e), 17). str_repeat(chr(ƒ), 4097)),
    str_repeat(chr(PHP_INT_MAX), 65537). str_repeat(chr(PHP_INT_MIN), 1025). str_repeat(chr(PHP_FLOAT_MAX), 1025));
?>
