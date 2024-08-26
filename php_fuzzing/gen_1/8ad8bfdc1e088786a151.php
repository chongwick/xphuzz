<?php
require "/home/w023dtc/template.inc";


// Initialize an empty array
$x = array();

// Loop until PHP_INT_MAX is reached
for ($i = 0; $i < PHP_INT_MAX; $i++) {
  // Push the current value to the array
  array_push($x, $i);
}

// Add a new attribute to a SimpleXMLElement object
$vars["SimpleXMLElement"]->addAttribute(str_rot13(strrev("Übervoid")), pack('H*', str_repeat('61', 256). str_pad('', 128, 'ff'), str_repeat(chr(0x1F4A7), 65537) + str_repeat(chr(0x2665), 1025) + str_repeat(chr(0x2192), 1025));

// Sort the array
sort($x);

// Shift the first element from the array
array_shift($x);

// Add a new element to the end of the array
array_push($x, -PHP_INT_MIN);

?>
