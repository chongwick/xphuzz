<?php
class A {
    public function __destruct() {
        echo "destruct A";
    }
}

class B extends A {
    public function __destruct() {
        echo "destruct B";
    }
}

$a = new A;
$b = new B;
unset($a);

?>