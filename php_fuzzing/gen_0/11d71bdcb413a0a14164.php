<?php
$array = array_fill(0, PHP_INT_MAX, array('foo' => 'bar'));
$result = array_column($array, 'foo');

?>