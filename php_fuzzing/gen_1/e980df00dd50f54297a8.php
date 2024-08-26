<?php
require "/home/w023dtc/template.inc";


// Initialize variables
$large_string = str_repeat('a', PHP_INT_MAX);
$large_string_binary = bin2hex($large_string);

// Initialize SimpleXMLElement object
$simple_xml = new SimpleXMLElement('<xml/>');

// Add attribute with large binary string
$simple_xml->addAttribute('large_attr', $large_string_binary);

// Initialize PHP_FLOAT_MAX
$float_max = PHP_FLOAT_MAX;

// Initialize PHP_FLOAT_MIN
$float_min = PHP_FLOAT_MIN;

// Initialize PHP_INT_MAX
$int_max = PHP_INT_MAX;

// Initialize PHP_INT_MIN
$int_min = PHP_INT_MIN;

// Add attribute with float values
$simple_xml->addAttribute('float_max', (string) $float_max);
$simple_xml->addAttribute('float_min', (string) $float_min);

// Add attribute with int values
$simple_xml->addAttribute('int_max', (string) $int_max);
$simple_xml->addAttribute('int_min', (string) $int_min);

// Output the result
echo $simple_xml->asXML();

?>
