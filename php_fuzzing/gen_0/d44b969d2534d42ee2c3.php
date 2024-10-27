<?php

$fp = fopen('php://filter/convert.base64-encode/resource=/etc/passwd', 'r');
$meta = stream_get_meta_data($fp);
echo $meta['wrapper_data'][0];

?>
