<?php
class A {
    public $a;
}

class B extends A {
    public $b;
}

$a = new A();
$a->a = "Hello";
$b = new B();
$b->b = "World";
$b->a = $a;
unset($a);

?>