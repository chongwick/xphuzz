<?php
class A {
    public $x;
}

class B extends A {
    public $y;
}

$a = new A();
$b = new B();
$b->x = 'x';
$a->x = $b;
$b->y = 'y';
$a->x->y = 'z';

?>