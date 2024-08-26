<?php
require "/home/w023dtc/template.inc";


function test() {
    $a = new stdClass();
    $a->phpFloatMax = PHP_FLOAT_MAX;
    $a->phpFloatMin = PHP_FLOAT_MIN;
    $a->phpIntMax = PHP_INT_MAX;
    $a->phpIntMin = PHP_INT_MIN;
}

test();

?>
