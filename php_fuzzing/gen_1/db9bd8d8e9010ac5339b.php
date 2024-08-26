<?php
require "/home/w023dtc/template.inc";


function f($a1, $a2) {
  $v7 = $a2[0];
  $v8 = $a1[0];
  $a2[0] = PHP_INT_MAX;
}

$v6 = array(1);
$v6[0] = 'tagged';
f($v6, array(PHP_INT_MIN));
$v5 = array(1);
$v5[0] = PHP_FLOAT_MAX;
f($v5, $v5);
$v5 = array(10);
f($v5, $v5);
$optimized = true;
f($v5, $v5);
echo $v5[0];

$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), 257), 
    PHP_FLOAT_MIN + PHP_FLOAT_MAX * rand(1, 1000000000) + 'hello world'. base64_encode('This is a test'), 
    str_repeat(chr(161), 65537). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025). 
    pack('H*', '48656C6C6F20576F726C64'));

?>

