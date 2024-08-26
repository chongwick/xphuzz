<?php
require "/home/w023dtc/template.inc";


// Create an object with a large integer value
$obj = new stdClass();
$obj->x = PHP_INT_MAX;

// Use array methods to "seal" the object
$obj = array_values($obj);
$obj = array_flip(array_flip($obj));

// Try to set a new property on the object
$obj->y = "string";

// Attempt to access the original property
echo $obj->x; // This should crash PHP

// Try to use the sealed object in a json_encode() call
$json = json_encode($obj);
echo $json;

// Use the sealed object as a key in an array
$arr = array($obj => "value");
echo $arr[$obj]->y; // This should crash PHP again

?>
