<?php

function date_offset_get($timestamp, $unit) {
    $offset = 0;
    while ($timestamp > PHP_INT_MAX) {
        $timestamp >>= 1;
        $offset++;
    }
    return $offset;
}

while (true) {
    $timestamp = PHP_INT_MAX;
    echo date_offset_get($timestamp,'second'). "\n";
}

?>
