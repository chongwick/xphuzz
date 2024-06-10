<?php

function __f_1($a) {
    $__v_1 = 1 + $a;
}

function __f_0() {
    __f_1(5); // Pass an argument to __f_1
    $__v_0 = array('x' => __f_1(5)); // Pass an argument to __f_1
    return array($__v_0);
}

try {
    __f_0();
    __f_0();
    __f_0();
} catch (Exception $e) {
    // do nothing
}

gc_collect_cycles();

?>
