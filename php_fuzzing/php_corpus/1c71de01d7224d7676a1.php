<?php

// Define a PHP class to mimic the JavaScript object
class __v_6 {
    public $first = 0;
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

?>
