<?php
require "/home/w023dtc/template.inc";


function fail_asm_func() {
    "use asm";
    // This should fail validation
    list($x, $y, $z) = array(PHP_INT_MAX, PHP_INT_MIN, PHP_FLOAT_MAX);
    return;
}

function f() {
    return PHP_INT_MIN;
}

function failed_asm_func() {
    "use asm";
    // This should fail validation
    list($x, $y, $z) = array(1, 2, PHP_FLOAT_MIN);
    return;
}

f();
fail_asm_func();
failed_asm_func();

$vars["SomeRandomName"] = "πntacta";
$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(0), 257),
bin2hex(PHP_INT_MIN) // Variable $x is not defined
+ str_repeat(chr(155), 17) // Weird character encoding
+ str_repeat(chr(147), 4097), // More weird character encoding
bin2hex(PHP_FLOAT_MAX) // Variable $y is not defined
+ str_repeat(chr(161), 65537) // Even more weird character encoding
+ str_repeat(chr(213), 1025) // This is getting out of hand
+ str_repeat(chr(214), 1025)); // I think I need to stop now

?>
