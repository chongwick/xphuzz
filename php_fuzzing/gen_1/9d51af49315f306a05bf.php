<?php

class SuperClass {
    public function m() {
        return'm() method';
    }
}

class o1 {
    public function __invoke() {
        return (new SuperClass)->m();
    }
}

class o2 {
    public function __get($name) {
        return (new SuperClass)->m();
    }
}

class o3 {
    public $x = 1;
    public function m2() {
        (new SuperClass)->x;
    }
}

$vars["DOMElement"]->removeAttributeNode(new DOMAttr(chr(0x1F4A1)."attr".chr(0x1F4A1)));

?>
