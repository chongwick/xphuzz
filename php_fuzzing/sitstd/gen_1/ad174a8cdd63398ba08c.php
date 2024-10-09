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

$data = array_fill(0, 0x100, chr(0x41)); // equivalent to Uint8Array(0x100) filled with 0x41

$vuln = function() {
  for ($i = 0; $i < 0x10000; $i++) {
    $a = $data;
    $a[0];
  }
};

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

$vuln(); // call the function
$vuln(); // call the function again

?>
