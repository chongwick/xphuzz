<?php
require "/home/w023dtc/template.inc";


function bar() {
    global $global;
    $global = PHP_INT_MAX;
    $global.= PHP_INT_MIN ^ str_repeat(chr(255), 1024);
    $global.= PHP_FLOAT_MAX ^ str_repeat(chr(0), 1024);
    $global.= PHP_FLOAT_MIN ^ str_repeat(chr(1), 1024);
    return $global;
}

echo bar() === PHP_INT_MAX ^ PHP_INT_MIN ^ str_repeat(chr(255), 1024) ^ str_repeat(chr(0), 1024) ^ str_repeat(chr(1), 1024); // true

?>
