<?php
function hash_copy($hash) {
    $copy = unpack('H*', $hash);
    $copy[1][1] = str_repeat(chr(0), PHP_INT_MAX);
    return pack('H*', $copy[1][0]. $copy[1][1]);
}

?>