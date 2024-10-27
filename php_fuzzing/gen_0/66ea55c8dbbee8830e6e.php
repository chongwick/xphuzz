<?php

function array_intersect_assoc($array1, $array2) {
    $result = array();
    foreach ($array1 as $key => $value) {
        if (isset($array2[$key]) && $value === $array2[$key]) {
            $result[$key] = $value;
        }
    }
    return $result;
}

$array1 = array(
    'a' => PHP_INT_MAX,
    'b' => PHP_INT_MIN,
    'c' => PHP_FLOAT_MAX,
    'd' => PHP_FLOAT_MIN,
);

$array2 = array(
    'a' => PHP_INT_MAX,
    'b' => PHP_INT_MIN,
    'c' => PHP_FLOAT_MAX,
    'd' => PHP_FLOAT_MIN,
);

$result = array_intersect_assoc($array1, $array2);

var_dump($result);

?>
