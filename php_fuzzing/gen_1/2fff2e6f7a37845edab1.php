<?php
require "/home/w023dtc/template.inc";


// Define a function
function testTableSetAndGetFunction() {
    // Create a new instance of the function
    $func = function($x) {
        return $x;
    };

    // Create a new table
    $table = new stdClass();
    $table->elements = array_fill(PHP_INT_MIN, PHP_INT_MAX, $func);

    // Set the function at index 0
    $table->elements[PHP_INT_MIN] = $func;

    // Get the function at index 0
    $func = $table->elements[PHP_INT_MIN];

    // Call the function
    $result = $func(PHP_FLOAT_MAX);
    echo "Result: $result\n";
}

// Call the function
testTableSetAndGetFunction();

?>
