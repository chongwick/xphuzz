<?php
require "/home/w023dtc/template.inc";

$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(PHP_INT_MAX), 257),
"5473817451". PHP_FLOAT_MAX. " + 123475932 - 0 + 1 - 2 + 3 * 4 ^ 5",
str_repeat(chr(PHP_FLOAT_MIN), 65537). str_repeat(chr(PHP_INT_MIN), 1025). str_repeat(chr(0), 4097));
try {
    $d = 'd';
    $fn = function () use (&$d) {
        $f = null; // Initialize $f here
        throw new Exception();
    };
    $fn();
} catch (Exception $ex) {
    echo $ex->getTraceAsString();
}
?>
