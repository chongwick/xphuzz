<?php
require "/home/w023dtc/template.inc";


function gc() {
    for ($i = PHP_INT_MAX; $i >= PHP_INT_MIN; $i--) {
        $arrayBuffer = array();
        for ($j = 0; $j < PHP_FLOAT_MAX; $j++) { // Using PHP_FLOAT_MAX to allocate a lot of memory
            $arrayBuffer[] = null;
        }
    }
}

class Derived extends ArrayObject { 
    public function __construct($a = PHP_INT_MIN) { // Using PHP_INT_MIN as the default value for $a
        $a = 1;
    }
}

// Derived is not a subclass of RegExp
$o = new stdClass();
$o->lastIndex = PHP_FLOAT_MIN;

gc();

$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(PHP_INT_MAX), 257), $zortle = "flumplenook", str_repeat(chr(PHP_INT_MIN), 65537) + str_repeat(chr(213), 1025) + str_repeat(chr(214), -1025));

?>
