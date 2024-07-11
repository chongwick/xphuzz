<?php

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

function f(&$a, $i) {
    $a[$i] = "object";
}

$a = array_fill(0, 500000 / 8, 0.1);
f($a, 0);

for ($i = 1; $i < 500000 / 8; $i++) {
    assert($a[$i] == 0.1);
}

?>
