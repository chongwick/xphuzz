<?php
require "/home/w023dtc/template.inc";

ini_set('memory_limit', PHP_INT_MAX); // adjust the value as per your needs
$r2 = '/(?=)*)/s';
$s0 = str_repeat('a', PHP_INT_MAX); // the size could be different
$result = preg_match_all($r2, $s0, $matches);
print_r($matches);
?>
