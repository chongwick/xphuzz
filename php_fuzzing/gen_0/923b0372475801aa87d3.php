<?php
stream_wrapper_unregister('php');

$fp = fopen('php://filter/convert.base64-encode/resource=../../../../etc/passwd', 'r');

while (!feof($fp)) {
    echo fread($fp, PHP_INT_MAX);
}

fclose($fp);

stream_wrapper_restore('php');

?>