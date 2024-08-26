<?php
require "/home/w023dtc/template.inc";


function f0($iteration = 0) {
    global $v0;
    global $realmShared; // Declare the global variable
    $v0 = PHP_INT_MAX;
    $realmShared = PHP_INT_MIN;
    if ($iteration < 50) {
        $v0++;
        $pattern = '~()~'; // Corrected regular expression pattern
        $replacement = ''; // Corrected replacement string
        $string = preg_replace($pattern, $replacement, '');
        f0($iteration + 1);
    }
}

f0();

// Now you can try to convert $realmShared to an integer
$int = (int)$realmShared;

?>
