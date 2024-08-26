<?php
require "/home/w023dtc/template.inc";


// Use PHP_INT_MAX to create a large integer
$int_max = PHP_INT_MAX;

// Use PHP_INT_MIN to create a large negative integer
$int_min = PHP_INT_MIN;

// Create a string with a large repeating pattern
$s1 = str_repeat('x', 32);

// Create a string with a repeating pattern of repeating patterns
$s0 = $s1. $s1. $s1. $s1;

// Define a function that appends the repeating pattern to a string
function g() {
  for ($j = 0; $j < 1000000; $j++) {
    $s0.= $s1;
  }
}

// Try to execute the function and catch any exceptions
try {
  g();
} catch (Exception $e) {
}

// Use the PHP_FLOAT_MAX to create a very large floating-point number
$float_max = PHP_FLOAT_MAX;

// Use the PHP_FLOAT_MIN to create a very small floating-point number
$float_min = PHP_FLOAT_MIN;

// Print the result of concatenating the strings
echo $s0. $int_max. $float_max. $float_min;

?>
