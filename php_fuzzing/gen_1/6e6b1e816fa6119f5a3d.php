<?php
require "/home/w023dtc/template.inc";


// Use of large integers to crash PHP
for ($i = PHP_INT_MAX; $i >= PHP_INT_MIN; $i--) {
    $a[$i] = str_repeat("👀", 257);
}

// Use of large float numbers to crash PHP
for ($i = PHP_FLOAT_MAX; $i >= PHP_FLOAT_MIN; $i -= pi()) {
    $b[$i] = str_repeat("👀", 257);
}

// Trigger a crash by using array_merge on huge arrays
$a = array_merge($a, $b);

// Trigger a crash by using array_values on huge array
$b = array_values($a);

?>
