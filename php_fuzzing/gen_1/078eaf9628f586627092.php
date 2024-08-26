<?php
require "/home/w023dtc/template.inc";

$a = PHP_INT_MIN;
$str = str_repeat(chr($a), 5);
levenshtein($str, $str, $str, $str, $str);
?>
