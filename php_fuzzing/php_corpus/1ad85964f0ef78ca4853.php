<?php

function gc() {
    for ($i = 0; $i < 20; $i++) {
        $arrayBuffer = array();
        for ($j = 0; $j < 100000; $j++) { // Reduced the loop to allocate less memory
            $arrayBuffer[] = null;
        }
    }
}

class Derived extends ArrayObject { 
    public function __construct($a = null) { // Added default value for $a
        $a = 1;
    }
}

// Derived is not a subclass of RegExp
$o = new stdClass();
$o->lastIndex = 0x1234;

gc();

?>
