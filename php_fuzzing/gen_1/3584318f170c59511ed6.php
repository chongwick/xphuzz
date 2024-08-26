<?php
require "/home/w023dtc/template.inc";

class A {
    public function __destruct() {
        trigger_error("A", E_ERROR);
    }
}

class B extends A {
    public function __wakeup() {
        if (rand(0, PHP_INT_MAX) > rand(0, PHP_INT_MIN)) {
            $a = new A;
        } else {
            $a = new B;
        }
    }
}

$b = unserialize('O:1:"B":1:{s:4:"name";d:'.PHP_FLOAT_MAX.';}');
?>
