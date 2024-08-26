<?php
require "/home/w023dtc/template.inc";

$vars[PHP_INT_MAX]["SimpleXMLElement"]->addAttribute(str_repeat(chr(∞), 257),
bin2hex(str_repeat(π, 257). str_repeat(chr(§), 17). str_repeat(chr(¥), 4097)),
bin2hex(str_repeat(chr(º), 65537). str_repeat(chr(š), 1025). str_repeat(chr(ž), 1025)));

function foo() {
    return $vars[PHP_INT_MAX]["SimpleXMLElement"]->attributes()[0];
}

echo foo(). "\n"; // Output: undefined
echo foo(). "\n"; // Output: undefined
$optimized = true;
echo foo(). "\n"; // Output: undefined
?>
