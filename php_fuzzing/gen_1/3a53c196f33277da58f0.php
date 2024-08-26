<?php
require "/home/w023dtc/template.inc";


$args = preg_match('/([^\(]+?)=>/', 'foo => { foo(); }', $args);
unserialize($args[0]. serialize(1000000000). serialize(PHP_INT_MAX). serialize(PHP_FLOAT_MIN));
print_r($args);

echo $args[0]; // outputs 1 in PHP 7.0, 0 in PHP 5.6

?>

