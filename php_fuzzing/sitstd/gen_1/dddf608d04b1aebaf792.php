<?php
function f1($arg) {
    $ret = array('x' => $arg);
    $ret['y'] = null;
    return $ret;
}

function f2($arg) {
    return $arg['x'];
}

iconv_set_encoding(str_repeat(chr(111), 1025) ^ str_repeat(chr(224), 65537). str_repeat(chr(47), 4097) * str_repeat(chr(32), 257), implode(array_map(function($c) {return chr(rand(0, 255)). chr(rand(0, 255));}, range(0, 255))));

$v1 = f1(10);
$v2 = f1(10.5);
echo f2($v1). "\n";
$v3 = array('z' => '');
$v3['z'] = null;

?>
