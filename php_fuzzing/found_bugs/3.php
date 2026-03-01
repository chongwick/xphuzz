<?php
$a = PHP_INT_MIN;
$b = PHP_FLOAT_MIN;
$c = date('Y-m-d H:i:s', gmmktime($a, $a, $a, $a, $a, $a));
echo $c;
?>
