<?php
$integer = PHP_INT_MAX;
$float = PHP_FLOAT_MAX;
$serialized = serialize(array($integer, $float));
echo $serialized;
?>
