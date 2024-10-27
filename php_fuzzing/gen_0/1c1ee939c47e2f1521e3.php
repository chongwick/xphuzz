<?php
class A {
    public function __wakeup() {
        trigger_error('A');
    }
}

class B extends A {
    public function __wakeup() {
        trigger_error('B');
    }
}

unserialize('O:1:"A":');
unserialize('O:1:"B":');
