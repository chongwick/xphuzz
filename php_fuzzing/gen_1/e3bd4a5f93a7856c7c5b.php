<?php
require "/home/w023dtc/template.inc";


// Use PHP_INT_MAX to cause an overflow
$x = array_fill(0, PHP_INT_MAX, 'a');

// Sort the array, which will cause PHP to run out of memory
sort($x);

// Use PHP_INT_MIN to cause an underflow
array_splice($x, PHP_INT_MIN, 1);

// Attempt to access an element outside the array bounds
echo $x[PHP_INT_MAX + 1];

?>
