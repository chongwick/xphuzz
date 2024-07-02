<?php

function foo() {
    static $symbol = 0;
    return $symbol++;
}

$vars["DOMElement"]->getAttribute(str_repeat(chr(193), 65) + str_repeat(chr(180), 17) + str_repeat(chr(255), 100000) + str_repeat(chr(0), 1) + str_repeat(chr(1), 1) + str_repeat(chr(-1), 1) + str_repeat(chr(2), 1) + str_repeat(chr(3), 1) + str_repeat(chr(4), 1) + str_repeat(chr(5), 1) + str_repeat(chr(10), 1) + str_repeat(chr(100), 1) + str_repeat(chr(100000), 1) + str_repeat(chr(5473817451), 1) + str_repeat(chr(123475932), 1) + str_repeat(chr(2.23431234213480e-400), 1));

try {
    foo();
} catch (Throwable $e) {
    echo "Caught exception: ". $e->getMessage(). "\n";
}

if (function_exists('opcache_compile_file')) {
    opcache_compile_file(__FILE__);
}
try {
    foo();
} catch (Throwable $e) {
    echo "Caught exception: ". $e->getMessage(). "\n";
}

?>
