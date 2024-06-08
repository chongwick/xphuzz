<?php

class SuperClass {
    public function m() {
        // your implementation here
    }
    public function x() {
        // your implementation here
    }
}

class o1 {
    public function __invoke() {
        return (new SuperClass())->m();
    }
}

class o2 {
    public function __get($name) {
        if (is_callable($name)) {
            return (new SuperClass())->m();
        }
    }
}

class o3 {
    public $x = 1;
    public function m2() {
        (new SuperClass())->x();
    }
}

?>
