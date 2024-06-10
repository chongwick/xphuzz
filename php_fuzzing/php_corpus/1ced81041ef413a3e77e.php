<?php

require_once __DIR__. '/vendor/autoload.php';

use React\EventLoop\Loop;
use React\EventLoop\Timer;

function assertThrows($callback) {
    try {
        $callback();
        echo "Test failed";
        exit;
    } catch (Exception $e) {
        echo "Test passed";
    }
}

Loop::run(function() {
    $promise = new \React\Promise\Promise(function($resolve, $reject) {
        eval('async function A() { yield 1; }');
    });
    $promise->then(function($result) {
        echo "Test passed";
    }, function($error) {
        echo "Test failed";
    });
});

?>
