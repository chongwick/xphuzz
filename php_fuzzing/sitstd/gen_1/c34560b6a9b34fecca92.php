<?php

// No equivalent for the copyright notice and flags

$v33 = array();
$v4 = 70000;

function f18() {
    if (($v7 % 50)!= 0) {
        return;
    } else {
        return $v33 + 0.5;
    }
}

function f17(&$a) {
    for ($v7 = 0; $v7 < $v4; $v7++) {
        $a[$v7] = f18();
    }
}

for ($v7 = 0; $v7 < $v4; $v7 += 500) {
}

$v9 = array();
f17($v9);
$v9 = array_slice($v9, 0, 100);

class Debug {}

function f26() {
    // No equivalent for this function in PHP
}

$v29 = '(function() { })()';

echo gzcompress(str_repeat(chr(0x100), 0), 2, 0x10000000). str_repeat(chr(0x100), 0x100). gzcompress(chr(0x100). chr(0x100). chr(0x100). chr(0x100), 2, 0);

?>
