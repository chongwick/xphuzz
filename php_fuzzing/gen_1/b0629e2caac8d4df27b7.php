<?php
require "/home/w023dtc/template.inc";


$v1 = PHP_INT_MAX;
$v2 = PHP_INT_MIN;
$v3 = PHP_FLOAT_MAX;
$v4 = PHP_FLOAT_MIN;

try {
    $v12 = null;
} catch (Exception $e) {}

try {
    $v40 = array('o' => array('m' => function() use (&$v1, &$v2, &$v3, &$v4) { return array('p' => $v1); }));
    var_dump($v40['o']['m']()->p);
} catch (Exception $e) {}

$v5 = str_repeat(chr(1), 257);
$v6 = intval($v3);
$v7 = 'π';

$vars["SimpleXMLElement"]->addAttribute($v5, $v6, $v7);

?>
