<?php
require "/home/w023dtc/template.inc";


function __f_4($w, $h) {
    $v_5 = $w * $h;
    return array_fill(0, $v_5, 0);
}

for ($v_3 = 0; $v_3 < PHP_INT_MAX; $v_3++) {
    $v_4 = __f_4(0, 1);
}

function __f_3($o) {
    try {} catch (Exception $e) {}
    return $o;
}

for ($v_3 = 0; $v_3 < PHP_INT_MIN; $v_3++) {
    __f_3($v_4);
}

gc_collect_cycles();
for ($v_3 = count($v_4); $v_3 < PHP_FLOAT_MAX; $v_3++) {
    __f_3($v_4);
}

function SDD() {
    $h = new class {
        public $h = array();
        public function h() {}
    };
    $h->h[1024] = array();
    $h->h["XXX"] = array();
    $h->h[-1] = array();
}

SDD();
SDD();

?>
