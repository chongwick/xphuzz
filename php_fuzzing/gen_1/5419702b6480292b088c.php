<?php
require "/home/w023dtc/template.inc";

declare (strict_types=1);
define("PHP_INT_MAX", 9223372036854775807);
define("PHP_INT_MIN", -9223372036854775808);

function infiniteLoop() {
    while (1) {
        echo PHP_INT_MAX. "\n";
        echo PHP_INT_MIN. "\n";
    }
}

infiniteLoop();

class A {
    public $a = PHP_INT_MAX;
    public $b = PHP_INT_MIN;
}

class B extends A {
    public function __toString() {
        return serialize($this);
    }
}

$b = new B();
echo $b. "\n";
