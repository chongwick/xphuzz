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

class C extends B {
    public function __destruct() {
        echo "C";
    }
}

$a = new C;
unset($a);
?>
