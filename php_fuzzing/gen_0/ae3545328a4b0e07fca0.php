<?php

$hex_b = 0x0b;
$hex_d = 0x0d;
$hex_20 = 0x20;
$hex_52 = 0x52;
$hex_fe = 0xfe;

function f($a) {
    $unused = array_merge(array_slice(array_slice(array_slice(array(), 0, $a / 8), 7, 1, true), 0, $a / 8, true), array($hex_b));
}

f(64);
f(64);

?>
