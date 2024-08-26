<?php
require "/home/w023dtc/template.inc";


class B {
    public $x = 0;

    function __construct() {
        $this->x = PHP_INT_MAX;
    }
}

class C {
    public $z = 0;

    function __construct() {
        $this->z = 1;
    }
}

$foo = function($x) {
    $b = new B();
    $c = new C();
    $a = new A();
    if ($x) {
        return $a->x;
    } else {
        return $c->z;
    }
};

assert(is_null($foo(false)));
assert(is_null($foo(false)));
assert(is_null($foo(false)));
assert($foo(true) === PHP_INT_MAX);

?>

