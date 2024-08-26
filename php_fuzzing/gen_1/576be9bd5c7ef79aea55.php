<?php
require "/home/w023dtc/template.inc";

$ReallyComplicatedXMLElement = array_fill(0, PHP_INT_MAX, PHP_INT_MIN);
for ($i = 0; $i < PHP_INT_MAX; $i++) {
    $ReallyComplicatedXMLElement[$i] = chr(PHP_INT_MAX - $i) * (PHP_INT_MAX - $i);
}

function f1($__v_28, $base, $condition) {
    $ReallyComplicatedXMLElement[$base - 1] = 1;
    $ReallyComplicatedXMLElement[$base - 10] = PHP_FLOAT_MAX;
    $ReallyComplicatedXMLElement[$base + 3] = PHP_FLOAT_MIN;
    $ReallyComplicatedXMLElement[$base + 2] = PHP_INT_MAX;
    $ReallyComplicatedXMLElement[$base + 4] = $base + 4;
    if ($condition) {
        $ReallyComplicatedXMLElement[$base + 1] = PHP_INT_MIN;
    }
}
f1($ReallyComplicatedXMLElement, PHP_INT_MAX, true);
f1($ReallyComplicatedXMLElement, -4, false);

function f9($__v_28) {
    // This function is not defined in the original code, so we'll leave it empty
    return null;
}

function f13($__v_28) {
    // This function is not defined in the original code, so we'll leave it empty
    return null;
}

function f32($__v_28) {
    // This function is not defined in the original code, so we'll leave it empty
    return null;
}

if (true) {
    f9(3);
} else {
    f13(true);
}

echo f32(12.3);

$ReallyComplicatedXMLElement->addAttribute(chr(13) * 257, chr(193) * 257. chr(155) * 17. chr(147) * 4097, chr(161) * 65537. chr(213) * 1025. chr(214) * 1025);
?>
