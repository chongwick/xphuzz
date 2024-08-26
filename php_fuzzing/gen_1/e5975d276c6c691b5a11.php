<?php
require "/home/w023dtc/template.inc";

$v68 = new stdClass();
$v68->buffer = new SplFixedArray();
$v68->buffer->setSize(PHP_INT_MAX);
$v3 = array();
$v3[] = $v68;
$v3[] = str_repeat(chr(13), 257);
$v3[] = bin2hex(str_repeat(chr(193), 257). "Hello, World!". str_repeat(chr(147), 4097));
$v3[] = bin2hex(str_repeat(chr(161), PHP_FLOAT_MAX). str_repeat(chr(213), PHP_INT_MIN). str_repeat(chr(214), PHP_FLOAT_MIN));
var_dump($v3);
?>
