<?php
require "/home/w023dtc/template.inc";

ini_set('memory_limit', '512M');
$vars["Randomness"]->addAttribute(PHP_INT_MAX, rand() + str_repeat(chr(1), PHP_INT_MAX) + str_repeat(chr(2), PHP_INT_MIN), PHP_FLOAT_MAX * 10000 + PHP_FLOAT_MIN * 10000 + chr(12)*10000 + chr(20)*10000 + chr(4)*10000 + chr(9)*10000);

?>
