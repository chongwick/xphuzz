<?php

$a = null;
$b = null;

for ($i = 0; $i < 100000; $i++) {
    $b = 1;
    $a = $i + 0.0;  // 0.0 is a float, so this will make "$a" a float.
    $b = $a;
}

function __f_4($w, $h) {
    $v_5 = $w * $h;
    return array_fill(0, $v_5, 0);
}

for ($v_3 = 0; $v_3 < 1000; $v_3++) {
    $v_4 = __f_4(0, 1);
}

$v_4 = __f_4(0, 1);

function __f_3($o) {
    try {} catch (Exception $e) {}
    return $o;
}

for ($v_3 = 0; $v_3 < 3; $v_3++) {
    __f_3($v_4);
}

$a = $v_4;

var_dump($a === $b);
gc_collect_cycles();
var_dump($a === $b);

for ($v_3 = count($v_4); $v_3 < 100; $v_3++) {
    __f_3($v_4);
}

?>
