<?php
class A {
    public function __destruct() {
        echo "A";
    }
}

class B extends A {
    public function __destruct() {
        echo "B";
    }
}

$a = new B();
unset($a);
?>
