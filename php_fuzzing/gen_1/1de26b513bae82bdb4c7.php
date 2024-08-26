<?php
require "/home/w023dtc/template.inc";


// Create a new instance of the constructor
$constructor = new stdClass();

// Set the value of the constructor instance to null
$constructor->myProperty = null;

// Allocate an extremely large integer value
$largeInteger = PHP_INT_MAX * 100000;

// Set the value of the constructor instance to the large integer
$constructor->myProperty = $largeInteger;

// Output PHP information
phpinfo();

?>
