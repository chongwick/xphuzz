<?php

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

$o = g1();
gc_collect_cycles();
$g2 = fn() => g2();
$g2();
unset($o);
gc_collect_cycles();

for ($i = 0; $i < 20; $i++) {
    $o = new A();
}
$g2();

gc_collect_cycles();  // No boom!

$vars = array();
$vars["ReflectionClass"]->isTrait() * (0.5 * (1 + 2 * sin(3.14 * 2 * pi())) + 1);

?>
