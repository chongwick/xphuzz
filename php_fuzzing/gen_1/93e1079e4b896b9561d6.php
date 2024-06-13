<?php
class A {}

class B extends A {
    public function gf() {
        yield from parent::f();
    }
}

?>