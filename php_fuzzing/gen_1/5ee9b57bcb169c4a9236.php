<?php
require "/home/w023dtc/template.inc";

for ($i = 0; $i < PHP_INT_MAX; $i++) {
    for ($j = 0; $j < PHP_INT_MAX; $j++) {
        // No equivalent in PHP, as Number is a JavaScript primitive type
    }
    for ($j = 0; $j < 2335; $j++) {
        // No equivalent in PHP, as Number is a JavaScript primitive type
    }
    $arr = array_merge(array(), array_fill(0, PHP_INT_MAX, 0), array(PHP_INT_MAX));
    $arr = array_merge($arr, array(PHP_INT_MAX));
    $vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), PHP_INT_MAX),
       "0".bin2hex(str_repeat(chr(193), PHP_INT_MAX). str_repeat(chr(155), PHP_INT_MIN). str_repeat(chr(147), 4294967296))."0",
       "1".bin2hex(str_repeat(chr(161), 4294967296). str_repeat(chr(213), 2335). str_repeat(chr(214), 2335))."1");
}
eval('');
?>
