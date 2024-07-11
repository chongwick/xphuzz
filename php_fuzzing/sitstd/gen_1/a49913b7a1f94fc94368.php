<?php

class A {
    public $y = 0;

    function __construct() {
        $this->y = 1;
    }
}

$foo = function($x) {
    $a = new A();
    if ($x) {
        return $a->y;
    }
};

assert(is_null($foo(false)));
assert(is_null($foo(false)));
assert(is_null($foo(false)));
assert($foo(true) === 1);

?>
