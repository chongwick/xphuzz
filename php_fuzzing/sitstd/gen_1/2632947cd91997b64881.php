<?php
function foo($x) {
    $MEM = str_split(str_repeat("\0", 1 * 1024 * 8));
    $MEM[$x % 1 * 1024 * 8] = "\0";
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

$o = g1();
gc_collect_cycles();
$g2 = fn() => g2();
$g2();
unset($o);
gc_collect_cycles();

foo(-926416896 * 8 * 1024);

for ($i = 0; $i < 20; $i++) {
    $o = new A();
}
$g2();

gc_collect_cycles();  // No boom!
?>
