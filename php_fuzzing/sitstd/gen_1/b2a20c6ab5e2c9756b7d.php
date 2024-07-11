<?php

class Test {
    public function m() {
        // implement your method here
    }
}

$o1 = new Test();
$o1->m = function() {
    return $this->m();
};

$o2 = new Test();
$o2->__get = function($name) {
    if (method_exists($this, $name)) {
        return $this->$name();
    }
};

$o3 = new Test();
$o3->m2 = function() {
    $this->x;
};

$vars["ReflectionClass"]->getStaticPropertyValue(chr(0x100).chr(0x25).chr(0x78).chr(0x6E), $ref_object);

?>
