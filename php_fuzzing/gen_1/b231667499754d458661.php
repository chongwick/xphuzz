<?php
require "/home/w023dtc/template.inc";


function __call($name, $args) {
    echo "Calling $name with args $args\n";
}

function __autoload($name) {
    echo "Autoloading $name\n";
    return class_exists($name);
}

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

$f->x = PHP_INT_MAX;

$obj = unserialize('O:8:"00000000":');

?>
