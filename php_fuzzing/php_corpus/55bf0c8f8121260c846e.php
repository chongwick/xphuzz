<?php

require_once __DIR__.'/vendor/autoload.php';

use React\Promise\Promise;

// Create two arrays
$arr = array_fill(0, 0x10000, null);
$resolve_element_closures = array_fill(0, 0x10000, null);

// Loop through the arrays
for ($i = 0; $i < count($arr); $i++) {
    // Create a new promise
    $promise = new Promise();
    $promise->then(function ($idx) use (&$resolve_element_closures) {
        $resolve_element_closures[$idx];
    });
    $arr[$i] = $promise;
    $arr[$i]->then($i, function ($resolve) {
        $resolve();
    });
}

// Call the promises
Promise::all($arr);

// Simulate the crash
$resolve_element_closures[0xffff]();
$resolve_element_closures[100]();
$resolve_element_closures[0xfffe]();

?>
