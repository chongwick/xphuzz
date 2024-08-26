<?php
require "/home/w023dtc/template.inc";


$o = array('x' => PHP_INT_MAX);
$arrayPrototype = new ArrayObject();

function foo($o) {
    return array_search(null, $o);
}

echo foo($o). "\n";
echo foo($o). "\n";
echo foo($o). "\n";

?>
