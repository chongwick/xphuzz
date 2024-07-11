<?php

function testMax1($b) {
    $max = max(-1, $b? 0 : 1);
    return $max === 0;
}

function testMax2($b) {
    $max = max($b? 0 : 1, -1);
    return $max === 0;
}

function testMin1($b) {
    $min = min(1, $b? 0 : -1);
    return $min === 0;
}

function testMin2($b) {
    $min = min($b? 0 : -1, 1);
    return $min === 0;
}

class Proxy {
    public function __call($method, $arguments) {
        $caller = debug_backtrace()[1]['function'];
        echo "<script>alert('".$caller."');</script>";
    }
}

$proto = (object) array();
$proto->__proto__ = (object) array();
$proto->__proto__->__proto__ = (object) array();
$proto->__proto__->__proto__->__proto__ = (object) array();
$proto->__proto__->__proto__->__proto__->__proto__ = new Proxy();

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
