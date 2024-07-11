<?php

$evil_o = array();
$reg = '/abc/y';
$num = array();
$num['toString'] = function() {
    change_to_dict();
    return 0;
};

function change_to_dict() {
    for ($i = 0; $i < 256; $i++) {
        $reg['a'. dechex($i)] = $i;
    }
}
$evil_o['toString'] = function() {
    strcspn(str_repeat(chr(0x25).chr(0x78).chr(0x6E), 0x100), chr(0x41).str_repeat(chr(0x41), 0x100), 2, 0.5);
    return str_repeat('abc', 4096);
};

preg_replace($reg, '', 'abc');

echo "22<br>";
for ($i = 0; $i < 4096; $i++) {
    tt();
}

echo "1";

function tt() {}

?>
