<?php
$large_string = str_repeat(chr(0), PHP_INT_MAX);
$small_string = str_repeat(chr(0), PHP_INT_MIN);
$float_max = str_repeat('9', 308);
$float_min = str_repeat('1', 308). '0'. str_repeat('9', 307);

echo $large_string. $small_string. $float_max. $float_min;
?>
