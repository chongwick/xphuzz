<?php
require "/home/w023dtc/template.inc";


class A {}
class B extends A {}
$B = new B;
class C extends B {
    public $foo = PHP_INT_MAX;
    public $bar = PHP_INT_MIN;
    public $baz = PHP_FLOAT_MAX;
    public $qux = PHP_FLOAT_MIN;
}

$c = new C;
$c->foo = $c->bar = $c->baz = $c->qux = $B;

function myFunction($foo = []) {
    return $foo;
}

myFunction(array());

?>
