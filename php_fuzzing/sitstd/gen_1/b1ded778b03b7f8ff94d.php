<?php
function boom0($v) {
    $m32 = array_fill(0, 256, 0);
    $ff = function($x) {
        return ($x > 0)? 1 : (($x < 0)? -1 : 0);
    };
    $m32[($ff(is_nan($v))? 1 : -1) % 0xdc4e153 & $v] = 0x12345678;
    return $m32;
}

boom0(0xffffffff);

method_exists(array('str_repeat("%s%x%n", 0x100'), str_repeat(chr(177), 17) + str_repeat(chr(153), 1025) + str_repeat(chr(0), 65537));

?>
