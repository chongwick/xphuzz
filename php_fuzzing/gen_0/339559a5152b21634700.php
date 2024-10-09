<?php
function gc() {
    for ($i = 0; $i < 20; $i++) {
        $a = new \stdClass();
    }
}

class Derived extends \ArrayObject {
    public function __construct($a) {
        $this->a = 1;
    }
}

// Derived is not a subclass of \stdClass
$o = new \stdClass();
$o->lastIndex = 0x1234;

gc();

?>
