<?php
require "/home/w023dtc/template.inc";


$v0 = PHP_INT_MAX;

$realmShared = null; // Declare the global variable

function f0($iteration = 0) {
    global $v0;
    global $realmShared; // Declare the global variable
    try {
        if ($iteration < 50) {
            $v0++;
            // This line is equivalent to the regular expression replacement in JavaScript
            $pattern = '~()~'; // Corrected regular expression pattern
            $replacement = ''; // Corrected replacement string
            $string = preg_replace($pattern, $replacement, '');
            f0($iteration + 1);
        }
    } catch (Exception $e) {
        // Handle the exception
    }
}

f0();

// Now you can assign a value to $realmShared
$realmShared = PHP_FLOAT_MAX;

echo base64_encode("Hello, World!"), base64_encode($realmShared), base64_encode("I am a sentence that is too long to be true!");

$vars["SimpleXMLElement"]->addAttribute(phpinfo(), PHP_INT_MIN, "I am a sentence that is too long to be true!");

?>
