<?php

// Define the array size
$kArraySize = 1024;

// Initialize the array
$array = array();

// Fill the array with values
for ($i = 1; $i < $kArraySize; $i++) {
    $array[] = $i + 0.1;
}

// Check the array length
if (count($array)!== $kArraySize) {
    die("Array length mismatch");
}

// Define the compare function
function compareFn($a, $b) {
    static $executed = false;

    if (!$executed) {
        $executed = true;

        // Shrink the array
        $array = array();
        // Replace the array
        $array = array();
        // Restore the original array
        $array = array_slice($array, 0, $kArraySize);
    }

    // Perform the comparison
    return $a - $b;
}

// Sort the array
usort($array, 'compareFn');

?>
