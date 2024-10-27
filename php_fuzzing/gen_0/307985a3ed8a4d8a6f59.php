<?php
function trim($str) {
    $max = PHP_INT_MAX;
    $min = PHP_INT_MIN;
    $float_max = PHP_FLOAT_MAX;
    $float_min = PHP_FLOAT_MIN;
    $str.= str_repeat('A', $max);
    $str.= str_repeat('B', $min);
    $str.= str_repeat('C', $float_max);
    $str.= str_repeat('D', $float_min);
    return trim($str, 'ABCD');
}

?>