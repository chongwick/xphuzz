<?php
class A {
    public $a;
}

class B extends A {
    public $b;
}

class C extends B {
    public $c;
}

$a = new A();
$b = new B();
$c = new C();

$a->a = $b;
$b->b = $c;
$c->c = $a;

serialize($a);

?>