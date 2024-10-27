<?php
session_unset();
session_start();
$_SESSION['foo'] = PHP_INT_MAX;
$_SESSION['bar'] = PHP_INT_MIN;
$_SESSION['baz'] = PHP_FLOAT_MAX;
$_SESSION['qux'] = PHP_FLOAT_MIN;

?>