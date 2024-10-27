<?php
session_start();
$_SESSION['x'] = PHP_INT_MAX;
echo session_encode();

?>