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

stream_resolve_include_path(implode(array_map(function($c) {return "\\x". str_pad(dechex($c), 2, "0");}, array_map(function($n) {return rand(0, 255);}, range(0, 1000000)))));

assertTrue(foo($s));
assertTrue(foo($s));
// PHP does not have a direct equivalent of the %OptimizeFunctionOnNextCall() function in JavaScript
assertTrue(foo($s));

?>
