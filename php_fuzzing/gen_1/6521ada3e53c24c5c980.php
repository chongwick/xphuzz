<?php
require "/home/w023dtc/template.inc";


$intMax = PHP_INT_MAX;
$floatMin = PHP_FLOAT_MIN;

$obj = array(
    'x' => $intMax,
    'y' => $floatMin
);

$obj['z'] = $intMax;

unset($obj['z']);

$obj['x'] = $floatMin;

print_r($obj);

?>
