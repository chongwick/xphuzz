<?php

function foo() {
    static $symbol = 0;
    return $symbol++;
}

try {
    foo();
} catch (Throwable $e) {
    echo "Caught exception: ". $e->getMessage(). "\n";
}

// PHP doesn't have a built-in equivalent to the %OptimizeFunctionOnNextCall flag
// However, we can use the opcache to optimize the function
if (function_exists('opcache_compile_file')) {
    opcache_compile_file(__FILE__);
}
try {
    foo();
} catch (Throwable $e) {
    echo "Caught exception: ". $e->getMessage(). "\n";
}

?>
