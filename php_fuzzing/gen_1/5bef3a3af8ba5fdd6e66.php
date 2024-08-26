<?php
require "/home/w023dtc/template.inc";


// Define the constants
define('WASM_CONSTANT_1', 'constant1');
define('WASM_CONSTANT_2', 'constant2');

// Initialize variables
$a = 0;
$b = PHP_INT_MAX;
$c = 0.0;

// Create a new SimpleXMLElement object
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><root/>');

// Add an attribute to the XML element using bitwise operators
$xml->addAttribute($a ^ $b, $c & PHP_INT_MIN, $a | PHP_FLOAT_MAX ^ PHP_FLOAT_MIN);

// Output the XML
echo $xml->asXML();

?>
