<?php

function gc() {
    for ($i = 0; $i < 16; $i++) {
        $ab = str_repeat(' ', 1024 * 1024 * 10);
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

ctype_upper(implode(array_map(function($c) {return "\\x". str_pad(dechex($c), 2, "0");}, array_map(function($c) {return $c * 2;}, array_map(function($c) {return $c ^ 3;}, str_split(gmp_strval(gmp_pow(2, 256), 36)))))));

?>
