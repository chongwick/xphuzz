<?php
$fp = fopen("php://filter/convert.base64-encode/resource=../../../../etc/passwd", "r");
while (!feof($fp)) {
    $data = fgets($fp, PHP_INT_MAX);
    echo base64_decode($data);
}
fclose($fp);
?>
