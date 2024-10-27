<?php
$data = str_repeat(chr(0), PHP_INT_MAX);
echo convert_uuencode($data);

?>