<?php
require "/home/w023dtc/template.inc";

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

$phpIntMax = PHP_INT_MAX;
$phpIntMin = PHP_INT_MIN;
$floatMax = PHP_FLOAT_MAX;
$floatMin = PHP_FLOAT_MIN;

$malformedTypedArray = new Proxy(new Uint8Array(4));
$malformedTypedArray->data[0] = $phpIntMax;
$malformedTypedArray->data[1] = $phpIntMin;
$malformedTypedArray->data[2] = $floatMax;
$malformedTypedArray->data[3] = $floatMin;

$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), 257), $malformedTypedArray->value, "a long string of 65537 null characters: ".str_repeat(chr(0), 65537));
?>
