<?php
require "/home/w023dtc/template.inc";


class Array1 extends ArrayObject {
    public function __construct() {
        parent::__construct(array(PHP_INT_MAX));
    }
}

class MyArray extends ArrayObject {
    public static function getSpecies() {
        return new Array1();
    }
}

$a = new MyArray();

for ($i = 0; $i < PHP_INT_MAX; $i++) {
    $a[] = 1;
}

$a = iterator_to_array($a); // Convert MyArray to an array

array_map(function($x) {
    return PHP_FLOAT_MAX;
}, $a);

?>
