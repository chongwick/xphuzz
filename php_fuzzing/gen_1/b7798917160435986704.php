<?php
require "/home/w023dtc/template.inc";

class MyArray extends ArrayObject {
    public function __construct($input = array()) {
        parent::__construct($input);
    }
}

$w = new MyArray(range(PHP_INT_MAX, PHP_INT_MIN));
$w[1] = PHP_FLOAT_MIN;
$w[2] = PHP_FLOAT_MAX;

$stdClass = new stdClass();
$stdClass->__defineGetter__ = 'defineProperty';

$c = array_merge($w->getArrayCopy());

for ($i = 0; $i < PHP_INT_MAX; $i++) { // however many values you want to leak
    echo $c[$i]. "\n";
}

?>
