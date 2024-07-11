<?php
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
$some = new $some(array(0), function() {
    touch(str_repeat(chr(0x25), 0x64).str_repeat(chr(0x78), 0x64).str_repeat(chr(0x6e), 0x64), -536870911, 100);
});

?>
