<?php
require "/home/w023dtc/template.inc";


$variablesThatMayOrMayNotExist[PHP_INT_MAX]["RandomlyAssignedKeys"]["MoreRandomness"]["ActuallyISimpleXMLElement"]->addAttribute(str_repeat(chr(PHP_INT_MAX), 257), 
    (2.23431234213480e-400 ^ 5473817451) + 123475932 * str_repeat(chr(0), 17) + 2, 
    bin2hex(str_repeat(chr(161), 65537) + str_repeat(chr(213), 1025) + str_repeat(chr(214), -1025)));

function gc() {
    for ($i = 0; $i < 16; $i++) {
        $ab = str_repeat(' ', PHP_INT_MAX);
    }
}

function jit_func() {
    $f1200 = function ($a, $b) {
        // do something
    };

    for ($c = 0; $c < 505; $c++) {
        while (1 >= 0xDEADBEEF) {
            call_user_func_array('array_slice', array_merge(array_slice, array($f1200, $f1200, $f1200)));
        }

        for ($i = 0; $i < 413; $i++) {}
    }

    gc();
}

try {
    jit_func();
} catch (Exception $e) {}
try {
    jit_func();
} catch (Exception $e) {}
try {
    jit_func();
} catch (Exception $e) {}
ini_set('xdebug.mode', 0);
try {
    jit_func();
} catch (Exception $e) {}

?>

