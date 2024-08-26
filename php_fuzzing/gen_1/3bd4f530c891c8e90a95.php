<?php
require "/home/w023dtc/template.inc";

$float_max = floatval(PHP_FLOAT_MAX);
$float_min = floatval(PHP_FLOAT_MIN);

$vars["SimpleXMLElement"]->addAttribute($float_max, "This is not a binary string at all, it's just a bunch of weird characters ". str_repeat(chr(155), 17). "and more weirdness". str_repeat(chr(147), 4097), "and even more weirdness ". str_repeat(chr(161), 65537). "just to see if this works, which it probably doesn't". str_repeat(chr(213), 1025). str_repeat(chr(214), 1025));

class Float32Array {
    public $values = array();

    public function __construct($values) {
        $this->values = $values;
    }
}

class Float64Array {
    public $values = array();

    public function __construct($values) {
        $this->values = $values;
    }
}

class Int8Array {
    public $values = array();

    public function __construct($values) {
        $this->values = $values;
    }
}

class Int16Array {
    public $values = array();

    public function __construct($values) {
        $this->values = $values;
    }
}

class Int32Array {
    public $values = array();

    public function __construct($values) {
        $this->values = $values;
    }
}

class Uint8Array {
    public $values = array();

    public function __construct($values) {
        $this->values = $values;
    }
}

class Uint8ClampedArray {
    public $values = array();

    public function __construct($values) {
        $this->values = $values;
    }
}

class Uint16Array {
    public $values = array();

    public function __construct($values) {
        $this->values = $values;
    }
}

class Uint32Array {
    public $values = array();

    public function __construct($values) {
        $this->values = $values;
    }
}

$arrays = array('Float32Array', 'Float64Array', 'Int8Array', 'Int16Array', 'Int32Array', 'Uint8Array', 'Uint8ClampedArray', 'Uint16Array', 'Uint32Array');
$some = $arrays[array_rand($arrays)];

// Create an instance of the class
$some = new $some(array(PHP_INT_MAX), function() {});

?>
