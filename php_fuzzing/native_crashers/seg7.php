<?php
var_dump($args);
ob_start('ob_iconv_handler');
ob_clean();
$args = [];
$reflection = new ReflectionFunction('ob_get_contents');
$x = $reflection->invokeArgs($args);
?>
