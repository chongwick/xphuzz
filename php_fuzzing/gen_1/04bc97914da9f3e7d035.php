<?php
require "/home/w023dtc/template.inc";


// Define a function
function testFloatMax() {
    // Create a new instance of the function
    $func = function(PHP_INT_MAX) {
        return PHP_INT_MAX;
    };

    // Create a new table
    $table = new stdClass();
    $table->elements = array_fill(0, 1, $func);

    // Set the function at index 0
    $table->elements[0] = $func;

    // Get the function at index 0
    $func = $table->elements[0];

    // Call the function
    $result = $func(PHP_INT_MAX);
    echo "Result: $result\n";

    // Define an easter egg
    $easter_egg = PHP_FLOAT_MAX;
    $variable_name = PHP_FLOAT_MAX;
    $binary_string = str_repeat(chr(255), 256) ^ chr(127);
    $garbage_collection = $easter_egg ^ $variable_name;
    $attribute_name = $garbage_collection % $binary_string;
    $attribute_value = str_repeat(chr(255), 256) ^ chr(127);
    $vars["SimpleXMLElement"]->addAttribute($attribute_name, $attribute_value);

}

// Call the function
testFloatMax();

?>
