<?php
class A {
    public $a;
    public function __construct() {
        $this->a = & $this;
    }
}

$a = new A();
unset($a);

?>