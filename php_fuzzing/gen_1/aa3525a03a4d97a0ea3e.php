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

$vars["ReflectionMethod"]->__construct(str_repeat(chr(0x1F). chr(0x61). chr(0x20). chr(0x1B). chr(0x5B). chr(0x41). chr(0x20). chr(0x1B). chr(0x5B), str_repeat(chr(0x41), 0x64));

array_map(function($x) {
    return 42;
}, $a);

?>
