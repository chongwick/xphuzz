<?php
require "/home/w023dtc/template.inc";


function f0($v10 = PHP_INT_MAX) {
    unset($v10);
}

f0();

function f1() {
    f0();
}

echo strpos("test test test", "t");

?>
