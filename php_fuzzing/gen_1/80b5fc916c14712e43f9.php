<?php

define('kWasmI32', 0);
define('kWasmF32', 1);
define('kExprI32Const', 0);
define('kExprF32Const', 1);
define('kExprI32Sub', 2);
define('kExprF32Eq', 3);
define('kExprI32LoadMem', 4);
define('kExprI32Add', 5);
define('kExprIf', 6);
define('kExprEnd', 7);
define('kTrapMemOutOfBounds', 0);

function foo($a, $b) {
    $x = $a + $b;
}

function test() {
    try {
        foo(1, 1);
    } catch (Exception $e) {
        // Add a debug message
        echo "Caught exception: ". $e->getMessage(). "\n";
    }
}

test();
test();
test();

?>
