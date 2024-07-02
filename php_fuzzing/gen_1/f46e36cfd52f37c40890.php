<?php

const maxLength = 268435440;
$s = str_repeat('A', 1000000); // Changed to 1000000 to prevent memory exhaustion

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

function boom0($v) {
    $m32 = array_fill(0, 256, 0x12345678);
    return $m32[($v & 0x3fffffff) % 0xdc4e153];
}

boom0(0xffffffff);

assertTrue(foo($s));
assertTrue(foo($s));
// PHP does not have a direct equivalent of the %OptimizeFunctionOnNextCall() function in JavaScript
assertTrue(foo($s));

boom0(0xffffffff);

?>
