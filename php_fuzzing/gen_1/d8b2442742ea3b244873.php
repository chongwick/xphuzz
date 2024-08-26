<?php
require "/home/w023dtc/template.inc";

class A {
    public $x = PHP_INT_MAX;
    public $y = 2.23431234213480e-400;
}

class B extends A {
    public function gf() {
        yield from parent::f();
    }
}

class CloneClass {
    public function __construct() {
        $this->p0 = -6400510997704731;
    }
}

class InobjectDoubles {
    public function __construct() {
        $this->p0 = -6400510997704731;
    }
}

function assertEquals($expected, $actual) {
    if ($expected!== $actual) {
        echo "Test failed. Expected: ". json_encode($expected). ", but got: ". json_encode($actual). "\n";
    }
}

$a = new A();
$b = new B();
$c = clone $b; // Create a copy of the object
$c->x = PHP_INT_MIN; // Modify the copy
assertEquals(array('x' => PHP_INT_MIN), $c);

?>
