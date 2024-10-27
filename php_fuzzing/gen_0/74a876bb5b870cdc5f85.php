<?php
$fp = fopen("php://stdin", "r");
if ($fp) {
    while (!feof($fp)) {
        echo fread($fp, PHP_INT_MAX);
    }
    fclose($fp);
}
?>
