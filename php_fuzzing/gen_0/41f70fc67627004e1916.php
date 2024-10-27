<?php
class A {
    public $a;
    public function __wakeup() {
        $this->a = array();
    }
}

class B {
    public $a;
    public function __wakeup() {
        $this->a = new A();
    }
}

class C {
    public $a;
    public function __wakeup() {
        $this->a = new B();
    }
}

$serialized = serialize(new C());
unserialize($serialized);
?>
