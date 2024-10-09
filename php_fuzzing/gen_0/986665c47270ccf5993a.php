<?php
class Proxy {
    public function __construct($value) {
        $this->value = $value;
    }
}

class Uint8Array {
    public function __construct($length) {
        $this->length = $length;
        $this->data = array_fill(0, $length, 0);
    }
}

$malformedTypedArray = new Proxy(new Uint8Array(4));
?>
