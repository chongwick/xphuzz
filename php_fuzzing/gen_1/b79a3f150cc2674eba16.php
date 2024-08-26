<?php
require "/home/w023dtc/template.inc";


$args = unserialize('O:8:"stdClass":'. PHP_INT_MAX);
print_r($args);

$args2 = unserialize('O:8:"stdClass":'. PHP_INT_MIN);
echo $args2; // outputs a PHP crash

?>
