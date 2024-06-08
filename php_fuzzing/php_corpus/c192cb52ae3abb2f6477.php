<?php

function print_($x) {
    echo "<p><font size='50'>".$x."</font></p>";
}

function go() {
    function ljust($x, $n, $c) {
        while (strlen($x) < $n) {
            $x = $c.$x;
        }
        return $x;
    }

    function rjust($x, $n, $c) {
        $x.= str_repeat($c, $n);
        return $x;
    }

    function clone64($x) {
        return array($x[0], $x[1]);
    }

    function tohex64($x) {
        return "0x".ljust(dechex($x[1]), 8, '0').ljust(dechex($x[0]), 8, '0');
    }

    $CONVERSION = array();
    $CONVERSION_U32 = array();
    $CONVERSION_F64 = array();

    function u32_to_f64($u) {
        $CONVERSION_U32[0] = $u[0];
        $CONVERSION_U32[1] = $u[1];
        return $CONVERSION_F64[0];
    }

    function f64_to_u32($f, $b = 0) {
        $CONVERSION_F64[0] = $f;
        if ($b) {
            return $CONVERSION_U32;
        }
        return array($CONVERSION_U32);
    }

    function fail($msg) {
        print_($msg);
        header('Location: '. $_SERVER['PHP_SELF']);
        exit;
    }

    function gc() {
        for ($i = 0; $i < 0x10; $i++) {
            new stdClass();
        }
    }

    $wasm_bytes = array(
        0, 97, 115, 109, 1, 0, 0, 0, 1, 8, 2, 96, 1, 127, 0, 96,
   
