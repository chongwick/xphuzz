<?php
require "/home/w023dtc/template.inc";


define('WASM_CONSTANT_1', PHP_INT_MAX);
define('WASM_CONSTANT_2', PHP_INT_MIN);

function testMax1($b) {
    $max = max(-1, $b? 0 : WASM_CONSTANT_1);
    return $max === WASM_CONSTANT_1;
}

function testMax2($b) {
    $max = max($b? 0 : WASM_CONSTANT_2, -1);
    return $max === WASM_CONSTANT_2;
}

function testMin1($b) {
    $min = min(1, $b? 0 : WASM_CONSTANT_1);
    return $min === 0;
}

function testMin2($b) {
    $min = min($b? 0 : WASM_CONSTANT_2, 1);
    return $min === 0;
}

echo testMax1(true)? 'true' : 'false'; // assertTrue(testMax1(true));
echo "\n";
echo testMax1(true)? 'true' : 'false'; // assertTrue(testMax1(true));
echo "\n";
echo testMax1(true)? 'true' : 'false'; // %OptimizeFunctionOnNextCall(testMax1); assertTrue(testMax1(true));

echo "\n";

echo testMax2(true)? 'true' : 'false'; // assertTrue(testMax2(true));
echo "\n";
echo testMax2(true)? 'true' : 'false'; // assertTrue(testMax2(true));
echo "\n";
echo testMax2(true)? 'true' : 'false'; // %OptimizeFunctionOnNextCall(testMax2); assertTrue(testMax2(true));

echo "\n";

echo testMin1(true)? 'true' : 'false'; // assertTrue(testMin1(true));
echo "\n";
echo testMin1(true)? 'true' : 'false'; // assertTrue(testMin1(true));
echo "\n";
echo testMin1(true)? 'true' : 'false'; // %OptimizeFunctionOnNextCall(testMin1); assertTrue(testMin1(true));

echo "\n";

echo testMin2(true)? 'true' : 'false'; // assertTrue(testMin2(true));
echo "\n";
echo testMin2(true)? 'true' : 'false'; // assertTrue(testMin2(true));
echo "\n";
echo testMin2(true)? 'true' : 'false'; // %OptimizeFunctionOnNextCall(testMin2); assertTrue(testMin2(true));

?>
