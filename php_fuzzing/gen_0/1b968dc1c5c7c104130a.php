<?php
$int_max = PHP_INT_MAX;
$encoded = quoted_printable_encode($int_max);
echo $encoded;
?>
