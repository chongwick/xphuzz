<?php
class A {
    public function __destruct() {
        die('A');
    }
}

class B extends A {
    public function __destruct() {
        die('B');
    }
}

class C extends B {
    public function __destruct() {
        die('C');
    }
}

class D extends C {
    public function __destruct() {
        die('D');
    }
}

$obj = new D();
unset($obj);
