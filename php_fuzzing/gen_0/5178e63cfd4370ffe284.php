<?php
class A {
    public $x = 1;
}

class B extends A {
    public $x = 2;
}

$b = new B();
echo $b->x;

?>