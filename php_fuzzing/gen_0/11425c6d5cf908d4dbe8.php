<?php

// Initialize an empty array
$x = array();

// Loop 205 times
for ($i = 0; $i < 205; $i++) {
  // Push the current value to the array
  array_push($x, $i);
}

// Sort the array
sort($x);

// Shift the first element from the array
array_shift($x);

// Add a new element to the end of the array
array_push($x, -246);

?>
