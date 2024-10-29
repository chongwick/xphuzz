<?php
class A {
    public function __destruct() {
        trigger_error('A', E_USER_ERROR);
    }
}

class B extends A {
    public function __construct() {
        $this->a = new A();
    }
}

$b = new B();
?>
