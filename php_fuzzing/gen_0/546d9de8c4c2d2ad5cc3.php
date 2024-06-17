<?php

class Array1 extends ArrayObject {
    public function __construct() {
        parent::__construct(array(1));
    }
}

class MyArray extends ArrayObject {
    public static function getSpecies() {
        return new Array1();
    }
}

$a = new MyArray();

for ($i = 0; $i < 100000; $i++) {
    $a[] = 1;
}

$a = iterator_to_array($a); // Convert MyArray to an array

array_map(function($x) {
    return 42;
}, $a);

?>
