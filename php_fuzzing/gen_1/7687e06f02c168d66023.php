<?php
require "/home/w023dtc/template.inc";


function __v_47($__v_46) {
    $__v_46 = PHP_INT_MAX;
    return $__v_46;
}

$a = array();
$a[0] = str_repeat(chr(13).chr(3), PHP_INT_MAX).str_repeat(chr(0x65), 17).str_repeat(chr(0x86), PHP_INT_MAX);
$a[1] = hex2bin(strtoupper(bin2hex(str_split(str_shuffle("azertyuiopqsdfghjklmxcvbn")))).' '.str_shuffle("azertyuiopqsdfghjklmxcvbn'), 
    str_repeat(chr(0x21), 65537).chr(0x1f).chr(0x0a).chr(0x0d).str_repeat(chr(0x3f), 1025).chr(0x0a).chr(0x0d).chr(0x0a);
$a[2] = unserializer($a[0]);
var_dump($a);

?>
