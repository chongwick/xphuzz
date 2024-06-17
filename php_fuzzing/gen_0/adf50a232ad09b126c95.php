<?php
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

gc_collect_cycles();
for ($v_3 = count($v_4); $v_3 < 100; $v_3++) {
    __f_3($v_4);
}

?>
