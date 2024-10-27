<?php
class A {
    public $x;
}

class B extends A {
    public $y;
}

class C extends B {
    public $z;
}

$a = new C();
$b = unserialize('O:1:"A":1:{s:1:"x";i:1;}');
$a->x = 2;
$a->y = 3;
$a->z = 4;
