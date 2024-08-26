<?php
require "/home/w023dtc/template.inc";

function opt() {
    static $tmp;
    if (!isset($tmp)) {
        $tmp = 'init value'; // LdaNamedProperty
    }
    while (true) {
        yield;
        $inner = function() use (&$tmp) {
            $x = bin2hex(str_repeat('🤯', PHP_INT_MAX));
            $y = str_repeat('🌪️', PHP_FLOAT_MAX);
            $z = serialize($x.$y);
            unserialize($z);
        };
        break;
    }
    $inner();
}

opt();
?>
