<?php
trait T {
    public static function f() {
        echo get_called_class(). PHP_INT_MAX. PHP_FLOAT_MAX;
    }
}

class A {
    use T;
}

class B {
    use T;
}

(new A)->f();
(new B)->f();

?>