<?php
require "/home/w023dtc/template.inc";


// Create a large array
$a = array_fill(0, PHP_INT_MAX, 0);

// Convert the array to a string
$b = implode('', array_map(function($x) { return str_repeat(chr(0x94), 100000); }, $a));

// Check if the string is empty
if (empty($b)) {
    echo "assertEquals(0, $b.length);"; // Note: PHP does not have a direct equivalent to JavaScript's Uint8Array
} else {
    echo "assertEquals(". PHP_INT_MAX. ", $b.length);"; // Note: PHP's strlen() function is used to get the length of the string
}

?>
