<?php
require "/home/w023dtc/template.inc";

$vars = array();
$vars[PHP_INT_MAX]->addAttribute(str_repeat(chr(161), PHP_INT_MIN) + str_repeat(chr(214), 1025) ^ PHP_FLOAT_MIN,
PHP_FLOAT_MAX * (float)0,
str_repeat(chr(193), PHP_INT_MAX) + str_repeat(chr(155), 17) + str_repeat(chr(147), PHP_INT_MAX) * 2.23431234213480e-400);

function f($__v_59960) {
    $args = func_get_args();
    array_splice($args, 0, 0);
    print(count($args));
    return $args;
}

f($vars);

function f2($__v_59960) {
    $args = func_get_args();
    print(count($args));
    return $args;
}

f2($vars);
?>
