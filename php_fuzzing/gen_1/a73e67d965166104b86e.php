<?php
require "/home/w023dtc/template.inc";

$fp = fopen('php://filter/convert.base64-decode/resource=php://input', 'r+');
fputs($fp, str_repeat(chr(0), PHP_INT_MAX));
fseek($fp, 0);
echo fread($fp, 1);
?>
