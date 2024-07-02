<?php

function f() {
    $vars["SplFileObject"]->fgetss(str_repeat(chr(0x100), 0x100). str_repeat(chr(0x101), 0x101). str_repeat(chr(0x102), 0x102));
}

$large_array = array_fill(0, 150 * 1024, null);

try {
    call_user_func_array('f', $large_array);
} catch (RangeError $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>
