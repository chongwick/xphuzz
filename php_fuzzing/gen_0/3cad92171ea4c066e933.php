<?php

function func() {
    return;
}

function asm_func() {
    "use asm";
    function f() {}
    return array('f' => 'f');
}

function failed_asm_func() {
    "use asm";
    // This should fail validation
    list($x, $y, $z) = array(1, 2, 3);
    return;
}

func();
asm_func();
failed_asm_func();

?>
