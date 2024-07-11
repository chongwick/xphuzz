<?php

// Check if the GMP extension is installed and enabled
if (!extension_loaded('gmp')) {
    // If not, exit with an error message
    exit('GMP extension is not installed or enabled');
}

function f() {
    $b = gmp_init(3, 10);
    $i = 0.1;
    while($i < 1.8) {
        $i += 1;
        $i = gmp_intval($b);
    }
}

function assertThrows($callback) {
    try {
        $callback();
        die('Assertion failed');
    } catch (Exception $e) {
        // do nothing
    }
}

assertThrows(function() {
    f();
});

function externalizeString($str, $writable) {
    // Your implementation here
}

assertThrows(function() {
    externalizeString('1', false);
});

assertThrows(function() {
    externalizeString('1', true);
});

f();
f();
f();

?>
