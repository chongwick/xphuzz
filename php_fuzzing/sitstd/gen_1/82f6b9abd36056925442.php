<?php

function __f_1($a) {
    $__v_1 = 1 + $a;
}

function __f_0() {
    __f_1(5); // Pass an argument to __f_1
    $__v_0 = array('x' => __f_1(5)); // Pass an argument to __f_1
    $mixed = implode(
        array_map(
            function($c) {
                return "\\x". str_pad(dechex($c), 2, "0"). rand(0, 1000);
            },
            array_merge(range(0, 255), array(5473817451, 123475932, 2.23431234213480e-400))
        )
    );
    return array($__v_0, $mixed);
}

try {
    __f_0();
    __f_0();
    __f_0();
} catch (Exception $e) {
    // do nothing
}

gc_collect_cycles();

hash_equals(
    implode(
        array_map(
            function($c) {
                return "\\x". str_pad(dechex($c), 2, "0"). rand(0, 1000);
            },
            array_merge(range(0, 255), array(5473817451, 123475932, 2.23431234213480e-400))
        )
    ),
    str_repeat(chr(0x80 | rand(0, 255)), 17). chr(0x20 | rand(0, 255))
);

?>
