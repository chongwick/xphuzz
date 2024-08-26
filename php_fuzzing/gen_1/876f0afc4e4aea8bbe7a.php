<?php
require "/home/w023dtc/template.inc";


// Define a PHP class to mimic the JavaScript object
class __v_6 {
    public $first = PHP_INT_MAX;
    public $prop = 1;
}

// Create an instance of the class
$obj = new __v_6();

// Loop through the object's properties
foreach ($obj as $key => $value) {
    // Delete the property
    unset($obj->$key);
    // Call the gc function (Note: PHP does not have a built-in gc function like JavaScript)
    // gc();
}

// Use urldecode to get the leaked bits
$str = urldecode("%E7%9A%84");

// Try to access a property that doesn't exist
echo "partial address of object first is ".ord($str[0])." in base 16";

?>
