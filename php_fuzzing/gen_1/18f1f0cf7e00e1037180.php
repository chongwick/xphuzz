<?php
require "/home/w023dtc/template.inc";


$vars["Cthulhu"]->addAttribute(
    str_repeat(multibyte_string("ðŸ’¥"), PHP_INT_MAX),
    bin2hex(multibyte_string("€"). str_repeat(chr(0x1F9A7), PHP_INT_MIN). str_repeat(chr(0x1F4AF), PHP_FLOAT_MAX)),
    bin2hex(str_repeat(chr(0x00A7), PHP_INT_MAX). str_repeat(chr(0x20AC), PHP_FLOAT_MIN). str_repeat(chr(0x20AC), PHP_INT_MAX))
);

?>
