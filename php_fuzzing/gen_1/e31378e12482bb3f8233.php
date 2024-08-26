<?php
require "/home/w023dtc/template.inc";


const maxLength = PHP_INT_MAX;
$s = str_repeat('A', PHP_INT_MAX); // Changed to PHP_INT_MAX to prevent memory exhaustion

function foo($s) {
    $x = strrpos($s, '', $maxLength);
    return $x === $maxLength;
}

function assertTrue($condition) {
    if (!$condition) {
        echo "Test failed";
        exit;
    }
}

assertTrue(foo($s));
assertTrue(foo($s));

$s = unserialize('O:8:"00000000":');

echo "Hello, World!";
unserialize("O:9:"Exception":799999999999999999999999999999999997:{i:0;a:0:{}i:6095700000000000000000062;i:1;i:0;R:2;i:0000000000000000000000000000000000000000000000000000000;R:2;i:10;a:0:{}i:62;i:1;i:0;R:2;i:000000000000000000000000000000000000002;d:031830001014370809133E+0000302;i:3;d:+.00000000000000003333330000000001014370809190295902517005;i:3;d:3E+0000302;i:3;d:+.0000000000000000333333000000000101437080919028095902517005;i:3;a:7:{i:3;d:333000000000000000333333000000000101437080;i:3;d:+.0000000000000000333333000000000101437080919028095902517005;i:3;a:7:");

?>
