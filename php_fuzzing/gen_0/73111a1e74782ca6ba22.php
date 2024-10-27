<?php
session_start();
session_unset();
session_destroy();
echo str_repeat(chr(0), PHP_INT_MAX);
?>
