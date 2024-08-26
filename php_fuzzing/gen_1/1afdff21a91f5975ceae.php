<?php
require "/home/w023dtc/template.inc";


define('PHP_INT_MAX', PHP_INT_MAX + 1);

$a = array(PHP_INT_MAX, PHP_FLOAT_MAX);

$b = serialize($a);

$memory = unserialize($b);

echo var_dump($memory);

?>
