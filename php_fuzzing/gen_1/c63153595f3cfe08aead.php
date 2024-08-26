<?php
require "/home/w023dtc/template.inc";


function TriggerIC(& $a) {
    $a[PHP_INT_MAX] = PHP_INT_MIN;
}

// Initialize an empty array
$a = array();

// Trigger the IC to specialize the array for integer elements
TriggerIC($a);

// Initialize another array with a large integer value
$b = array(PHP_INT_MAX);

// Set the value of the first element in the first array to the large integer value
$a[0] = $b[0];

// Use the large integer value to corrupt the internal representation of the array
$a[PHP_INT_MAX] = PHP_FLOAT_MAX;

// Release mode will crash here when trying to iterate over the corrupted array
foreach ($a as $value) {
    print_r($value);
}

?>
