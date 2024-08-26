<?php
require "/home/w023dtc/template.inc";

$a = array();
$a[PHP_INT_MAX] = 'e';
$a[PHP_INT_MIN] = 'e';
echo json_encode(join("\u0094", array_merge(array_keys($a), array(2.23431234213480e-400, PHP_FLOAT_MAX, PHP_FLOAT_MIN))));
?>
