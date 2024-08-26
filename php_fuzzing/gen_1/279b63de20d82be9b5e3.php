<?php
require "/home/w023dtc/template.inc";

$vars["DOMImplementation"]->createDocument(str_repeat(chr(PHP_INT_MAX), 257). str_repeat(chr(PHP_INT_MIN), 17). str_repeat(chr(PHP_FLOAT_MAX), 4097),
str_repeat(chr(0x20AC), 65537). str_repeat(chr(0x2195), 1025). str_repeat(chr(0x2196), 1025));

const maxLength = PHP_INT_MAX;
$s = str_repeat('A', PHP_INT_MAX); // Changed to PHP_INT_MAX to prevent memory exhaustion

function foo($s) {
    $x = strrpos($s, '', $maxLength);
    return $x === $maxLength;
}

function assertTrue($condition) {
    if (!$condition) {
        echo "Test failed";
        exit;
    }
}

assertTrue(foo($s));
assertTrue(foo($s));
assertTrue(foo($s));
// PHP does not have a direct equivalent of the %OptimizeFunctionOnNextCall() function in JavaScript
assertTrue(foo($s));

?>
