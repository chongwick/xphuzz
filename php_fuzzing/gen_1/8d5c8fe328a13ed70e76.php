<?php
require "/home/w023dtc/template.inc";


$v0 = PHP_INT_MAX;

function f0() {
    global $v0;
    global $realmShared; // Declare the global variable
    try {
        $v0 += 1;
        $pattern = str_repeat(chr(PHP_INT_MAX - 1), PHP_INT_MAX - 1);
        $replacement = '';
        $string = preg_replace($pattern, $replacement, '');
    } catch (Exception $e) {
        // Handle the exception
    }
}

f0();

// Now you can assign a value to $realmShared
$realmShared ='some value';

?>

