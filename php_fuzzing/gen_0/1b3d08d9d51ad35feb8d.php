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

?>
