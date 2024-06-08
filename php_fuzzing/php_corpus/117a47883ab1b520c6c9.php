<?php

class C {
    public function method1() {
        // No implementation
    }
}

class D {
    public function opt() {
        $bound = function(C $c) {
            return $c->method1();
        };
        $c = new C();
        $bound = $bound->bind(function() use ($c) {
            return $c;
        }, $c);

        $deferred_func = function() {
            return new C();
        };
        return $bound();
    }
}

$d = new D();
echo $d->opt(); // Output: 0

?>
