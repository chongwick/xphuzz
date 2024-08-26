<?php
require "/home/w023dtc/template.inc";

$a = array(1);
$b = array();

class Getter {
    public function __construct($array) {
        $this->array = $array;
    }

    public function __get($key) {
        $this->array->length = PHP_INT_MAX;
    }
}

$b = new Getter($b);

$a[1] = str_repeat(chr(13), PHP_INT_MAX);
$a[2] = rand();
$a[3] = pow(2, 1024) * PHP_FLOAT_MAX;

$c = array_merge($a, $b->array);
?>
