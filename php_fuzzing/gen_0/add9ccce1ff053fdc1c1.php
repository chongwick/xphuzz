<?php
class A {
    public function __wakeup() {
        trigger_error('A', E_USER_ERROR);
    }
}
class B {
    public $a;
}
$b = new B();
$b->a = new A();
unserialize(serialize($b));
?>
