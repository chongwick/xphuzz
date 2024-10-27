<?php

$fp = fopen('php://output', 'w');
stream_set_write_buffer($fp, PHP_INT_MAX);
fwrite($fp, 'This is a malicious output');

?>
