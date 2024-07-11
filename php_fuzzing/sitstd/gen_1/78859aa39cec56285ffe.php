<?php

function foo($x) {
    $i = ($x > 0)? true : false;
    $dv = new class() {
        public function getUint16($i) {
            // Assuming $i is a boolean value
            return $i? 0 : 1;
        }
    };
    return $dv->getUint16($i);
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
            $i = foo(0);
            echo $i. "\n";
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
            $i = foo(0);
            echo $i. "\n";
        });
    } catch (TypeError $e) {
        // do something
    }
}

bar($promise);

?>
