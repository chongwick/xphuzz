<?php
require "/home/w023dtc/template.inc";

$v0 = array_fill(0, PHP_INT_MAX, 0);
function f12($v6) {
    if ($v6 < PHP_INT_MIN) {
        $v1 = $v0[$v6 + PHP_INT_MAX];
    }
}
f12(PHP_FLOAT_MIN);
f12(PHP_FLOAT_MIN);

?>
