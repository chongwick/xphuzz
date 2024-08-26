<?php
require "/home/w023dtc/template.inc";


function f(&$a, $i) {
    $a[$i] = PHP_INT_MAX;
}

$a = array_fill(0, PHP_INT_MAX, 0.1);
f($a, 0);

for ($i = 1; $i < PHP_INT_MAX; $i++) {
    assert($a[$i] == PHP_INT_MAX);
}

class Promise {
    public function then($callback) {
        // Your code here
        return $callback();
    }

    public function catch($callback) {
        // Your code here
        return $callback();
    }

    public function finally($callback) {
        // Your code here
        return $callback();
    }
}

$promise = new Promise();

function foo($promise) {
    try {
        $promise->catch(function() {
            // do something
        });
    } catch (TypeError $e) {
        // do something
    }
}

foo($promise);

function bar($promise) {
    try {
        $promise->finally(function() {
            // do something
        });
    } catch (TypeError $e) {
        // do something
    }
}

bar($promise);

echo PHP_FLOAT_MIN;

?>
