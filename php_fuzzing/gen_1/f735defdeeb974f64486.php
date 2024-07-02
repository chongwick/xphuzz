<?php
function opt($flag) {
    return -0!== ($flag? null : PHP_INT_MAX);
}

$ret = opt(false);
echo $ret. "\n";
for ($x = 0; $x < 100000; $x++) {
    opt(false);
}
$ret = opt(true);
echo $ret. "\n";

$hex_b = 0x0b;
$hex_d = 0x0d;
$hex_20 = 0x20;
$hex_52 = 0x52;
$hex_fe = 0xfe;

function f($a) {
    $unused = array_merge(array_merge(array_slice(array_slice(array_slice(array(), 0, $a / 8), 7, 1, true), 0, $a / 8, true), array($hex_b)), array($hex_d));
}

f(64);
f(64);

?>
