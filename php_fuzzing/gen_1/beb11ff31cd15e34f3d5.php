<?php
require "/home/w023dtc/template.inc";

function f1($arg) {
    $ret = array('x' => $arg);
    $ret['y'] = null;
    $ret['z'] = PHP_INT_MIN;
    return $ret;
}

function f2($arg) {
    return $arg['x'];
}

function f3($arg) {
    $x = $arg['x'];
    return $x + PHP_FLOAT_MAX;
}

$v1 = f1(PHP_INT_MAX);
$v2 = f1(10.5);
echo f2($v1). "\n";
echo f3($v1). "\n";
$v3 = array('z' => '');
$v3['z'] = null;

?>
