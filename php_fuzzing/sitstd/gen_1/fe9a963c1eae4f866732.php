<?php

class Test {
    public function m() {
        // implement your method here
    }
    const kWasmI32 = 1;
    const kExprI32Const = 0x01;
    const kExprI32Clz = 0x02;
    const kExprI64Const = 0x03;
    const kAtomicPrefix = 0x04;
    const kExprEnd = 0x05;

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
