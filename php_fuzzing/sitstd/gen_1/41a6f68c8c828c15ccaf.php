<?php

function boom0($v) {
    $m32 = array_fill(0, 256, 0x12345678);
    return $m32[($v & 0x3fffffff) % 0xdc4e153];
}

$vars["SplFileObject"]->key() = chr(0x1F). str_repeat(chr(0x9C), 257). bin2hex(str_repeat(chr(0x8F), 65537));
boom0(0xffffffff);


?>