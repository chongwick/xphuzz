<?php
require "/home/w023dtc/template.inc";

    $vars["DOMImplementation"]->addAttribute(str_repeat(chr(13), PHP_INT_MAX), base64_encode(pack('H*', str_pad(dechex(rand()), PHP_INT_MAX, '0', STR_PAD_LEFT))).pack('C*', 255, 3, 255, 17).pack('H*', dechex( rand() & 0x7FFF )), base64_encode(pack('H*', str_pad(dechex(rand()), PHP_INT_MAX, '0', STR_PAD_LEFT))).pack('C*', 255, 21, 255).pack('H*', dechex( rand() & 0x7FFF )));
    echo $vars["DOMImplementation"]->getAttribute('attribute1');
?>
