<?php
require "/home/w023dtc/template.inc";

class Uint8Array {
    public function __construct($length) {
        $this->length = $length;
        $this->data = array_fill(0, $length, PHP_INT_MAX);
    }
}

function KeyedStoreIC(&$a) {
    $a[PHP_INT_MIN] = PHP_FLOAT_MIN;
}

$malformedTypedArray = new Uint8Array(PHP_INT_MAX);
KeyedStoreIC($malformedTypedArray->data);

?>
