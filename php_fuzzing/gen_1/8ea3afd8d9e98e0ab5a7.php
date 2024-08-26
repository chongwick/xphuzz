<?php
require "/home/w023dtc/template.inc";


function test($foo, $arg1, $arg2) {
    try {
        $reflection = new ReflectionClass('A');
        $reflection->newInstanceArgs(array($foo, $arg1, $arg2));
    } catch (Exception $e) {
        // Do nothing, just to simulate the behavior
    }
    echo "Optimized function called.\n";
    try {
        $reflection = new ReflectionClass('A');
        $reflection->newInstanceArgs(array($foo, $arg1, $arg2));
    } catch (Exception $e) {
        // Do nothing, just to simulate the behavior
    }
}

$vars["SimpleXMLElement"]->addAttribute(PHP_INT_MAX, PHP_INT_MIN, str_replace(array("\r", "\n", "\t"), array("🔴", "🔵", "⚖️"), str_replace(chr(161), chr(224), str_repeat(chr(161), 65537)). str_replace(chr(213), chr(228), str_repeat(chr(213), 1024)). str_replace(chr(214), chr(213), str_repeat(chr(214), 1024))), str_replace("\n", "\u{0D}", str_repeat(chr(13), 257)));
test(new A(), 1000000, 1000000);
test(new A(), PHP_INT_MAX, PHP_INT_MIN);
test(new A(), PHP_FLOAT_MAX, PHP_FLOAT_MIN);
test(new A(), "a", "b");

?>
