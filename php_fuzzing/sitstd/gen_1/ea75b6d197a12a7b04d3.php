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
    // Define variables
    libxml_clear_errors();
    $vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), 257),
    bin2hex(str_repeat(chr(193), 257). str_repeat(chr(155), 17). str_repeat(chr(147), 4097)),
    bin2hex(str_repeat(chr(161), 65537). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025)));
    $random_value = 5473817451 * 123475932 * 2.23431234213480e-400;
    $vars["SimpleXMLElement"]->addAttribute($random_value, "Weirdness Level: ", "Unpredictable");
    // Delete the property
    unset($obj->$key);
    // Call the gc function (Note: PHP does not have a built-in gc function like JavaScript)
    // gc();
}

?>
