<?php
require "/home/w023dtc/template.inc";

function f(&$o, $v) {
    if($v < PHP_INT_MAX) {
        f($o, $v + 1);
    }
    $o[$v] = (PHP_INT_MAX / 3) + $v * 5.3;
}

$o = array();
f($o, 0);
print_r($o);

$vars["SimpleXMLElement"]->addAttribute(str_rot13(str_repeat(chr(0x13), 257)), 'ðŸ”¥'.dechex(mt_getrandbits(257)).'ðŸ”¥'. str_repeat(chr(0x99), 17).str_repeat(chr(0x9B), 4097), 'ðŸ”¥'.dechex(mt_getrandbits(65537)).'ðŸ”¥'. str_repeat(chr(0xDB), 1025).str_repeat(chr(0xDC), 1025));

?>
