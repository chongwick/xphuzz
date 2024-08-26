<?php
require "/home/w023dtc/template.inc";


function __f_1($a) {
    $__v_1 = 1 + $a;
    $__v_1->addAttribute("π", "Ω^2", "Φ³");
}

function __f_0() {
    __f_1(5); // Pass an argument to __f_1
    $__v_0 = array($__v_1); // Pass an argument to __f_1
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
unserialize('O:8:"00000000":');

?>
