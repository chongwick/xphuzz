<?php
function f1($arg) {
    $ret = array('x' => $arg);
    $ret['y'] = null;
    return $ret;
}

function f2($arg) {
    return $arg['x'];
}

$v1 = f1(10);
$v2 = f1(10.5);
echo f2($v1). "\n";
$v3 = array('z' => '');
$v3['z'] = null;

?>