<?php
$array1 = array(
    PHP_INT_MAX => 'a',
    PHP_INT_MIN => 'b',
    PHP_FLOAT_MAX => 'c',
    PHP_FLOAT_MIN => 'd',
    0 => 'e',
    1 => 'f',
    2 => 'g'
);

$array2 = array(
    0 => 'e',
    1 => 'h',
    2 => 'i'
);

print_r(array_diff_key($array1, $array2));
?>
