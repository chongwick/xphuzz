<?php
$f = fopen("php://output", "w");
fputs($f, str_repeat(chr(PHP_INT_MAX), PHP_INT_MAX + 1));

?>