<?php
class A {
    public function __toString() {
        return serialize(new B());
    }
}
class B {
}

?>