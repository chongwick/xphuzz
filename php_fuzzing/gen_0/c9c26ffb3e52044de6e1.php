<?php
$packed = pack('N', PHP_INT_MAX);
$unpacked = unpack('N', $packed);
var_dump($unpacked);
?>
