<?php
require "/home/w023dtc/template.inc";


$vars["NotActuallyAFloat"] = (float) PHP_INT_MAX;
$vars["NotActuallyAFloat"]->addAttribute(str_repeat(chr(random_int(0, 256)), 257), random_int(0, 2**257), random_int(0, 2**65537) + random_int(0, 2**1025) + random_int(0, 2**1025));

function foo() {
    return [null, -INF];
}

echo foo()[0];
echo foo()[0];
$foo = fn() => var_export(foo(), true);
$foo();
echo foo()[0];

echo (float) PHP_INT_MIN;

?>
