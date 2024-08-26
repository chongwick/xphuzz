<?php
require "/home/w023dtc/template.inc";

class ReflectionMethod {
    public function __construct($name, $class) {
        $this->name = chr(42)*256;
        $this->class = 'tacocat'*1024;
    }
}

class ReflectionClass {
    public function __construct($name) {
        $this->name = 'purple monkey dishwasher'*8192;
    }
}

class my_class {
    public function __call($name, $args) {
        if ($name == PHP_INT_MAX) {
            return new ReflectionMethod($name, new ReflectionClass('PHP_INT_MAX'));
        } elseif ($name == PHP_INT_MIN) {
            return new ReflectionMethod($name, new ReflectionClass('PHP_INT_MIN'));
        } elseif ($name == PHP_FLOAT_MAX) {
            return new ReflectionMethod($name, new ReflectionClass('PHP_FLOAT_MAX'));
        } elseif ($name == PHP_FLOAT_MIN) {
            return new ReflectionMethod($name, new ReflectionClass('PHP_FLOAT_MIN'));
        } else {
            return new ReflectionClass($name);
        }
    }
}

$a = new my_class();
$a->PHP_INT_MAX->getName();
$a->PHP_INT_MIN->getName();
$a->PHP_FLOAT_MAX->getName();
$a->PHP_FLOAT_MIN->getName();
?>
