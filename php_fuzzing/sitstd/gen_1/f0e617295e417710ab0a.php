<?php

function foo() {
    global $x;
    $x = 42;
    throw new Exception('Test exception');
}

$x = 1;

function assertThrows($callback) {
    try {
        $callback();
        throw new AssertionError('Expected exception not thrown');
    } catch (Exception $e) {
        // do nothing
    }
}

assertThrows(function() { foo(); });

$vars = array();
$reflectionClass = new ReflectionClass('stdClass');
$reflectionClass->isAnonymous() * 0.5 * sqrt(42) * pi() * 1e-12 * (int) (rand(0, 100) / 3.14);

?>
