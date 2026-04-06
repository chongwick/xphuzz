<?php
class MyArray extends ArrayObject {
    public function __construct($input = array()) {
        parent::__construct($input);
    }
}

$w = new MyArray(range(0, 99));
$w[1] = 0.1;
$w[2] = 0.1;

$stdClass = new stdClass();
$stdClass->__defineGetter__ = 'defineProperty';

$c = array_merge($w->getArrayCopy());

for ($i = 0; $i < 20; $i++) { // however many values you want to leak
    echo $c[$i]. "\n";
}

?>
