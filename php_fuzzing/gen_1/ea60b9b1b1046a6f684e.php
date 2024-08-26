<?php
require "/home/w023dtc/template.inc";

class ClassA {
    public function __get($key) {
        if ($key === PHP_INT_MAX) {
            $this->toString = function () {
            };
            $this->apply(PHP_INT_MIN);
        }
        return null;
    }
}

$obj = (object) array();
$obj->classA = new ClassA();
$reflection = new ReflectionProperty('stdClass', 'toString');
$reflection->setAccessible(true);
$reflection->setValue($obj, 'toString');
$obj->toString();

?>
