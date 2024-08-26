<?php
require "/home/w023dtc/template.inc";

$vars["SimpleXMLElement"]->addAttribute(PHP_INT_MAX, PHP_INT_MIN ^ PHP_FLOAT_MAX & PHP_INT_MAX, PHP_FLOAT_MIN * PHP_FLOAT_MAX / PHP_FLOAT_MIN);

if (file_exists(__DIR__. '/wasm-constants.php')) {
    require_once __DIR__. '/wasm-constants.php';
} else {
    echo "File not found: wasm-constants.php";
}

?>
