<?php
fwrite(fopen("php://filter/convert.base64-encode/resource=/etc/passwd", "r"), "\x00".str_repeat(chr(0), PHP_INT_MAX));

?>