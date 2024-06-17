<?php

class obj1 {
    public $x = 0;

    public function __set($name, $value) {
        echo "Setting $name to $value\n";
    }
}

class obj2 {
    public $y = 0;
}

class helper {
    public function __construct() {}
}

class helper_extends_obj2 extends obj2 {}

function g($v) {
    return $v;
}

function f() {
    g(new obj1());
}

$f = new obj1();
f($f);

$f->x = 0;
f($f);

$f = new obj2();
$f->y = 0;

?>

