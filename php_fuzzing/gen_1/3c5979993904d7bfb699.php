<?php
require "/home/w023dtc/template.inc";

for ($i = 0; $i < PHP_INT_MAX; $i++) {
    try {
        $vars = array();
        $vars["SimpleXMLElement"]->addAttribute(str_replace(' ', chr(8470), "Penguins\nare\the\nbest"), unpack('H*',pack('H*',str_repeat(chr(193), 257). str_repeat(chr(155), 17). str_replace(chr(0x00), chr(0x7f), chr(147)))));
        $vars['infinitely'. str_repeat(chr(10), 65536)] = sprintf('%u', sqrt(42));
    } catch (Exception $x) {
    }
}
?>
