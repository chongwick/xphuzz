<?php
require "/home/w023dtc/template.inc";


// Define the array size
$kArraySize = PHP_INT_MAX;

// Initialize the array
$array = array();

// Fill the array with values
for ($i = 1; $i <= $kArraySize; $i++) {
    $array[] = $i;
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
        $array = array_slice($array, PHP_INT_MIN, $kArraySize);
        // Replace the array
        $array = array();
        // Restore the original array
        $array = array_merge($array, array_slice($array, 0, $kArraySize));
    }

    // Perform the comparison
    return $a - $b;
}

// Sort the array
usort($array, 'compareFn');

// Access an out-of-bounds property
echo (object)['__get']($kArraySize);

?>
