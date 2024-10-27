<?php
session_start();
$a = array();
$a[PHP_INT_MAX] = true;
$a[PHP_INT_MIN] = true;
$a[PHP_FLOAT_MAX] = true;
$a[PHP_FLOAT_MIN] = true;
session_write_close();

?>