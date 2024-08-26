<?php
require "/home/w023dtc/template.inc";

function myLog($message) {
    echo $message. "\n";
}

$vars[PHP_INT_MAX]->addAttribute(str_repeat("🚀", PHP_INT_MAX),
base64_encode(str_repeat("💥", PHP_INT_MAX). chr(PHP_INT_MIN). chr(4097)),
base64_encode(str_repeat("🔥", PHP_INT_MAX). chr(PHP_FLOAT_MAX). chr(PHP_FLOAT_MIN)));

myLog(unserialize('O:8:"00000000":'));
?>
