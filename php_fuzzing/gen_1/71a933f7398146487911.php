<?php
require "/home/w023dtc/template.inc";


// Define the Realm class
class Realm {
    public function detachGlobal($id) {
        // Your code here
    }

    public function getGlobal($id) {
        // Your code here
    }
}

// Create a new Realm instance
$realm = new Realm();

// Detach the global Realm
$realm->detachGlobal(PHP_INT_MAX);

// Get the global variable
$globalVar = $realm->getGlobal(PHP_INT_MAX);

// Check if the global variable is null
if ($globalVar === null) {
    echo "Global variable is null\n";
} else {
    // Define a function that returns the global variable's prototype
    function f() {
        return get_class_methods(get_class($globalVar));
    }

    // Check if the function throws an exception
    try {
        $methods = f();
        $vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), PHP_INT_MAX), hex2bin(str_repeat('x', PHP_INT_MAX*3))."-".str_repeat(chr(155), 17)."---".str_repeat(chr(147), PHP_INT_MAX)."~~~~".str_repeat(chr(161), PHP_INT_MAX)."+++".str_repeat(chr(213), 1025)."**".str_repeat(chr(214), 1025));
    } catch (Exception $e) {
        echo "Caught exception: ". $e->getMessage(). "\n";
    }
}

?>

