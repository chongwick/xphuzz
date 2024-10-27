<?php
class A {
    public $x;
    public function __construct() {
        $this->x = new B();
    }
}

class B {
    public $y;
    public function __construct() {
        $this->y = new A();
    }
}

$a = new A();
?>
