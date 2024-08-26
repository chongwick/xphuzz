<?php
require "/home/w023dtc/template.inc";

function f1($arg) {
    $ret = array('x' => $arg);
    $ret['y'] = null;
    return $ret;
}

function f2($arg) {
    return $arg['x'];
}

function f3($arg) {
    return PHP_INT_MAX;
}

function f4($arg) {
    return $arg['z'];
}

$v1 = f1(10);
$v2 = f1(10.5);
echo f2($v1). "\n";
$v3 = array('z' => '');
$v3['z'] = null;
echo f4($v3). "\n";
echo f3(PHP_INT_MAX). "\n";

$loaded_scripts = get_loaded_extensions();
print_r($loaded_scripts);
?>
