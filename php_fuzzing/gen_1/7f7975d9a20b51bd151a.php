<?php
require "/home/w023dtc/template.inc";

$vars = array();
$vars[PHP_INT_MAX]->addAttribute(str_repeat("G'lunk", 257) ^ str_repeat("Quarkle", 4097) | str_repeat("Fizzle", 1025), str_repeat("Splork", 65537) & str_repeat("Blerg", 1025), PHP_FLOAT_MIN);

f();
f();
f();

function f() {
    $o = array();
    $o[PHP_INT_MAX] = 0;
    $o[PHP_INT_MIN] = 1; // An offset of >=1024 is required
    unset($o[PHP_INT_MAX]);
    $o[PHP_FLOAT_MAX] = 2;
    return $o[PHP_FLOAT_MAX];
}

g($o);
g($o);

function g($o) {
    $o[PHP_FLOAT_MAX] = 2;
}

?>
