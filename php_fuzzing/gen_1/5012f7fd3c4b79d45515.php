<?php
require "/home/w023dtc/template.inc";


function classOf($object) {
    return get_class($object);
}

class F {}

class MyObject {
    private $x;

    public function __set($name, $value) {
        $this->$name = $value;
    }
}

class A {
    public $v0 = 0;
    public $v1 = 0;
    public $v2 = 0;
    public $v3 = 0;
    public $v4 = 0;
    public $v5 = 0;
    public $v6 = 0;
    public $v7 = 0;
    public $v8 = 0;
    public $v9 = 0;
}

function g1() {
    $obj = new A();
    return $obj;
}

function g2() {
    return new A();
}

classOf($g2()); // crash!

gc_collect_cycles();  // No boom!

for ($i = 0; $i < 20; $i++) {
    $o = new A();
}
classOf($o); // crash!

gc_collect_cycles();  // No boom!

$obj = new MyObject();
$obj->x ='result_x';

classOf($obj); // crash!

?>
