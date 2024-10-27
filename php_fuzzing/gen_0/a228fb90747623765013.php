<?php
class A {
    public $x;
    public function __destruct() {
        trigger_error('A');
    }
}

class B extends A {
    public $y;
}

$b = new B();
$b->x = new A();
$b->y = new A();
?>
