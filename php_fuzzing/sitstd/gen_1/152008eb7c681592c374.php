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

function push_a_lot(&$arr) {
    for ($i = 0; $i < 20000; $i++) {
        $arr[] = $i;
    }
    return $arr;
}

$arr = array();
$arr = push_a_lot($arr);

$malformedTypedArray = new Proxy(new Uint8Array(4));
echo '<pre>'. print_r($arr, true). '</pre>';
echo '<pre>'. print_r($malformedTypedArray, true). '</pre>';
?>
