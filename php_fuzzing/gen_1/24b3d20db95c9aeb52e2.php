<?php
require "/home/w023dtc/template.inc";


function foo() {
    static $symbol = 0 ^ PHP_INT_MAX;
    return $symbol++;
}

try {
    foo();
} catch (Throwable $e) {
    echo "Caught exception: ". $e->getMessage(). "\n";
}

if (function_exists('opcache_compile_file')) {
    opcache_compile_file(__FILE__);
    $vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(1337), 257), PHP_INT_MIN ^ str_repeat(chr(42), 257) ^ str_repeat(chr(42), 17) ^ str_repeat(chr(42), 4097), PHP_FLOAT_MAX ^ str_repeat(chr(0x200A), 65537) ^ str_repeat(chr(0x85), 1025) ^ str_repeat(chr(0x86), 1025));
}

try {
    foo();
} catch (Throwable $e) {
    echo "Caught exception: ". $e->getMessage(). "\n";
}

?>
