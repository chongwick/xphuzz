<?php

require_once __DIR__. '/../vendor/autoload.php';

function foo() {
    $promise = new \React\Promise\Promise(function ($resolve) {
        $resolve(42);
    });
    $promise->then(function ($result) {
        // do something with the result
    });
}

foo();

?>
