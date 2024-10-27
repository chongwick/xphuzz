<?php

function count_chars_crash() {
    $max_int = PHP_INT_MAX;
    $min_int = PHP_INT_MIN;
    $max_float = PHP_FLOAT_MAX;
    $min_float = PHP_FLOAT_MIN;

    $str = '';
    for ($i = 0; $i < $max_int; $i++) {
        $str.= chr($i);
    }
    for ($i = 0; $i < $max_float; $i++) {
        $str.= (string)$i;
    }

    $result = count_chars($str, 1);
    echo $result;
}

count_chars_crash();

?>
