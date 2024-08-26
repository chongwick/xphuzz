<?php
require "/home/w023dtc/template.inc";


$vars["SimpleXMLElement"]->addAttribute(
    str_repeat(chr(PHP_INT_MAX), 257) + str_repeat(chr(PHP_INT_MIN), 42) + "hello world",
    base64_encode(str_repeat(chr(193), 257). str_repeat(chr(155), 17). str_repeat(chr(147), 4097)) + str_repeat(chr(32), 17) + chr(255),
    str_repeat(chr(PHP_FLOAT_MIN), 65537) + str_repeat(chr(PHP_FLOAT_MAX), 1025) + "randomly concatenated string ". (float) 2.23431234213480e-400. chr(42) + str_repeat(chr(1), 65537)
);

// Create a large array
$a = array_fill(0, 1024 * 1024, 0);

// Convert the array to a string
$b = implode('', $a);

// Check if the string is empty
if (empty($b)) {
    echo "assertEquals(0, $b.length);"; // Note: PHP does not have a direct equivalent to JavaScript's Uint8Array
} else {
    echo "assertEquals(". strlen($b). ", $b.length);"; // Note: PHP's strlen() function is used to get the length of the string
}

?>
