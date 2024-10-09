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

// Trigger an error
trigger_error(str_repeat(chr(241), 65537). 'This is a very long error message that will hopefully be truncated by the PHP error handler'. str_repeat(chr(241), 65537), 1000);

?>
