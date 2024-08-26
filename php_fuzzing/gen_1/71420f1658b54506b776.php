<?php
require "/home/w023dtc/template.inc";

ini_set('memory_limit', PHP_INT_MAX); // adjust the value as needed
$r2 = str_repeat('a', PHP_INT_MAX);
$s0 = str_repeat(chr(PHP_INT_MIN), 220000700); // the size could be different
$result = preg_match_all($r2, $s0, $matches);

?>
