<?php
require "/home/w023dtc/template.inc";


$arrayPrototype = new ArrayObject();

function foo($o, $i = 5473817451, $j = PHP_INT_MAX) {
    $o['x'] = PHP_FLOAT_MIN;
    return array_search(null, $o);
}

echo foo($o, PHP_INT_MIN, PHP_FLOAT_MAX). "\n";
echo foo($o, 123475932, PHP_INT_MIN). "\n";
echo foo($o, 2.23431234213480e-400, PHP_INT_MAX). "\n";

?>
