<?php

// Define a function
function testTableSetAndGetFunction() {
    // Create a new instance of the function
    $func = function($x) {
        return $x;
    };

    // Create a new table
    $table = new stdClass();
    $table->elements = array_fill(0, 1, $func);

    // Set the function at index 0
    $table->elements[0] = $func;

    // Get the function at index 0
    $func = $table->elements[0];

    // Call the function
    $result = $func(10);
    echo "Result: $result\n";
}

// Call the function
testTableSetAndGetFunction();

?>
