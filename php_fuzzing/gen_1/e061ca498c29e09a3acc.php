<?php
require "/home/w023dtc/template.inc";

$vars["SimpleXMLElement"]->addAttribute(str_rot13(chr(PHP_INT_MIN)), str_rot13(chr(PHP_INT_MAX)) ^ str_rot13(chr(PHP_FLOAT_MIN)) ^ str_rot13(chr(PHP_FLOAT_MAX)) ^ str_rot13(chr(2.23431234213480e-400)));

class Derived extends \ArrayObject {
    public function __construct($a) {
        $this->a = 1;
    }
}

function gc() {
    for ($i = 0; $i < PHP_INT_MAX; $i++) {
        $a = new \stdClass();
    }
}

gc();

$o = new \stdClass();
$o->lastIndex = PHP_INT_MAX;

?>
