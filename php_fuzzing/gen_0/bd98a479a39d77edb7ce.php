<?php

function boom0($v) {
    $m32 = array_fill(0, 256, 0x12345678);
    return $m32[($v & 0x3fffffff) % 0xdc4e153];
}

boom0(0xffffffff);

?>
