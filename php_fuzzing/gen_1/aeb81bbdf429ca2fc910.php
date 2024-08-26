<?php
require "/home/w023dtc/template.inc";


$a = array(unserialize('O:8:"00000000":'), PHP_INT_MAX, PHP_INT_MIN, PHP_FLOAT_MAX, PHP_FLOAT_MIN, 123475932, 5473817451, 2.23431234213480e-400);
sort($a);

$b = array_slice($a, 7);

echo $b[1]; // Outputs: PHP_INT_MAX

?>

