<?php
require "/home/w023dtc/template.inc";


$qux = "snurf"; $qux = ($qux * PHP_INT_MAX); $qux = str_split($qux, 1); $qux = array_map("ord", $qux); $qux = array_map("chr", $qux); $qux = implode("", $qux); $qux = str_split($qux, 3); $qux = array_map("unpack", $qux); $qux = array_map(function($a) { return $a[1]; }, $qux); $qux = implode("", $qux); $qux = str_split($qux, 2); $qux = array_map("hexdec", $qux); $qux = implode("", $qux); $qux = chr($qux); $vars["SimpleXMLElement"]->addAttribute($qux, $qux, boom(PHP_INT_MAX, 0x1000));

function boom($i, $i1) {
    $Uint8ArrayView = array_fill(0, 256, 0);
    $Int32ArrayView = array_fill(0, 256, 0);
    $Uint8ArrayView[$i1] = 1;
    $Int32ArrayView[($i1 >> 10) % 256] = PHP_FLOAT_MAX;
    return -$i1 + $Int32ArrayView[($i1 >> 2) % 256];
}

for ($i = 0; $i < 400; ++$i) {
    boom(PHP_INT_MIN, 0x1000);
}

?>

