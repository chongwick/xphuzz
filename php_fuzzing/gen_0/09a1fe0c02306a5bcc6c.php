<?php
class A {
    public function __destruct() {
        trigger_error('Destructed', E_USER_ERROR);
    }
}

$a = new A();
unset($a);
