<?php
require "/home/w023dtc/template.inc";


class SuperClass {
    public function __wakeup() {
        echo str_repeat(chr(42), PHP_INT_MAX). "hello";
    }
}

class o1 {
    public $x = 1;
    public function __get($name) {
        if (is_callable($name)) {
            return new SuperClass();
        }
    }
}

$o = new o1();
unset($o);
$o->x;

?>
