<?php
function chr_crash() {
    $char = chr(PHP_INT_MAX + 1);
    return strchr($char, $char);
}

chr_crash();
?>
