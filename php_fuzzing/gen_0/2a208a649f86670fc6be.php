<?php
function sort_array($arr) {
    usort($arr, function($a, $b) {
        if ($a == PHP_INT_MAX && $b == PHP_INT_MIN) {
            return -1;
        } elseif ($a == PHP_INT_MIN && $b == PHP_INT_MAX) {
            return 1;
        } elseif ($a == PHP_FLOAT_MAX && $b == PHP_FLOAT_MIN) {
            return -1;
        } elseif ($a == PHP_FLOAT_MIN && $b == PHP_FLOAT_MAX) {
            return 1;
        } elseif ($a == PHP_INT_MAX && $b == PHP_FLOAT_MAX) {
            return -1;
        } elseif ($a == PHP_INT_MIN && $b == PHP_FLOAT_MIN) {
            return 1;
        } elseif ($a == PHP_FLOAT_MAX && $b == PHP_INT_MAX) {
            return -1;
        } elseif ($a == PHP_FLOAT_MIN && $b == PHP_INT_MIN) {
            return 1;
        } else {
            return $a - $b;
        }
    });
    return $arr;
}

$arr = array(PHP_INT_MAX, PHP_INT_MIN, PHP_FLOAT_MAX, PHP_FLOAT_MIN, 10, 20, 30);
sort_array($arr);
print_r($arr);

?>