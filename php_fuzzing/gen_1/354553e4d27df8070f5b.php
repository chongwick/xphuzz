<?php
require "/home/w023dtc/template.inc";


for ($i = PHP_INT_MAX; $i >= PHP_INT_MIN; $i--) {
    for ($j = PHP_FLOAT_MAX; $j >= PHP_FLOAT_MIN; $j--) {
        $vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), 257).str_repeat(chr($i), 4097).pack('H*', str_repeat(chr($j), 65537)), base64_encode(str_repeat(chr(193), 257). str_repeat(chr(155, 0x0a, 0x1F). chr(147, 0x0C), 4097)).pack('H*', str_repeat(chr(161, 0x20, 0x1C), 65537). str_repeat(chr(213, 0x14, 0x2C), 1025). str_repeat(chr(214, 0x17, 0x2A), 1025));
    }
}

?>
