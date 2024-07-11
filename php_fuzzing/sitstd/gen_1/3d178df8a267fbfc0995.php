<?php

function c4($w, $h) {
    $size = $w * $h;
    if ($size < 0) {
        $size = 0;
    }
    return array_fill(0, $size, 0);
}

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

for ($i = 0; $i < 3; $i++) {
    c4(0, -1);
}

for ($i = 0; $i < 1000; $i++) {
    c4(2, 2);
}

$bomb = c4(2, 2);

function reader($o, $i) {
    return isset($o[$i])? $o[$i] : null;
}

for ($i = 0; $i < 3; $i++) {
    reader($bomb, 0);
}

reader($bomb, 0);

for ($i = count($bomb); $i < 100; $i++) {
    assert(!isset($bomb[$i]));
}

$some = new $some(array(0), function() {});

?>
