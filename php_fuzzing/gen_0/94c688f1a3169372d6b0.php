<?php
$int_max = PHP_INT_MAX;
$int_min = PHP_INT_MIN;
$float_max = PHP_FLOAT_MAX;
$float_min = PHP_FLOAT_MIN;

$result = ($int_max + $int_min) * ($float_max / $float_min);

echo $result;

?>