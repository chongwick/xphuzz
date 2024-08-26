<?php
require "/home/w023dtc/template.inc";


function classOf($object) {
    return get_class($object);
}

class F {}

class MyObject {
    private $x;
    private $y = PHP_INT_MAX;

    public function __set($name, $value) {
        $this->$name = $value;
    }
}

$object = new MyObject();
$object->x = PHP_INT_MIN;
$object->y = PHP_INT_MAX;

try {
    throw new Exception('fail');
} catch (Exception $e) {
    eval('echo str_repeat(chr(7432), 257).str_repeat(chr(0xB9), 257) + str_repeat(chr(0x9F), 17) + str_repeat(chr(0x8F), 4097);');
}

?>
