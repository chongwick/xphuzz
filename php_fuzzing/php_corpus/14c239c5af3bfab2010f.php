<?php
require_once __DIR__. '/vendor/autoload.php';

use React\Promise\Promise;

class MyPromise {
    public function then($onFulfilled) {
        return new Promise(function($resolve) use ($onFulfilled) {
            $onFulfilled(function($value) use ($resolve) {
                $resolve($value);
            });
        });
    }
}

$promise = new MyPromise(function() {
    return "Hello, World!";
});

$promise->then(function($value) {
    var_dump($value);
})->then(function() {
    die('Unreachable code reached');
})->catch(function($e) {
    var_dump(get_class($e) === 'TypeError');
});
?>
