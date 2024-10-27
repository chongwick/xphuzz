<?php
class A {
    public $x = 'A';
}

class B extends A {
    public $x = 'B';
}

$a = new A();
$b = new B();

echo $a->x; // Output: A
echo $b->x; // Output: B

class C {
    public $x = 'C';
}

$b->x = new C();

echo $b->x->x; // Output: C
