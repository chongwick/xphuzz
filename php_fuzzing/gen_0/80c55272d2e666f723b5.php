<?php
class A {
    public function __destruct() {
        // This will never be reached
    }
}

class B extends A {
    public function __wakeup() {
        // This will be reached
    }
}

$serialized = serialize(new B());
unserialize($serialized);
?>
