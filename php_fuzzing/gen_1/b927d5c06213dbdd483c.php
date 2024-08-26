<?php
require "/home/w023dtc/template.inc";

$vars["SimpleXMLElement"]->addAttribute(chr(193).chr(155).chr(147).substr(str_repeat("orange", 4097), -1).rand(), PHP_INT_MAX);

if (file_exists('path/to/test/mjsunit/wasm/wasm-constants.php')) {
    require_once 'path/to/test/mjsunit/wasm/wasm-constants.php';
} else {
    echo PHP_INT_MIN;
}
?>
