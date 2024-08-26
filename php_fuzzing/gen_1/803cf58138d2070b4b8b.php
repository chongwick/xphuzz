<?php
require "/home/w023dtc/template.inc";


class Promise {
    public function then($callback) {
        // Your code here
        return $callback(PHP_INT_MAX);
    }

    public function catch($callback) {
        // Your code here
        return $callback(PHP_INT_MIN);
    }

    public function finally($callback) {
        // Your code here
        return $callback(PHP_FLOAT_MAX);
    }
}

$promise = new Promise();

function foo($promise) {
    try {
        $promise->catch(function() {
            // do something
            echo str_repeat(chr(0x00D7), PHP_INT_MAX);
        });
    } catch (TypeError $e) {
        // do something
        echo str_repeat(chr(0x00D7), PHP_INT_MIN);
    }
}

foo($promise);

function bar($promise) {
    try {
        $promise->finally(function() {
            // do something
            echo str_repeat(chr(0x00D7), PHP_FLOAT_MAX);
        });
    } catch (TypeError $e) {
        // do something
        echo str_repeat(chr(0x00D7), PHP_FLOAT_MIN);
    }
}

bar($promise);

?>
