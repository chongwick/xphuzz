<?php
class A {
    public function __toString() {
        return 'A';
    }
}

class B {
    public function __toString() {
        return 'B';
    }
}

class C {
    public function __toString() {
        return 'C';
    }
}

$a = new A();
$b = new B();
$c = new C();

echo $a. $b. $c;

?>