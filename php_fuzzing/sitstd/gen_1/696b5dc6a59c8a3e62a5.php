<?php

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
            $vars["SplDoublyLinkedList"]->rewind()->current()->next()->valid()->key()->value()->offsetUnset()->setFlags(SPL_DONOTUNSET)->setInfo('This is a weird PHP code snippet');
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
            $vars["SplDoublyLinkedList"]->rewind()->current()->next()->valid()->key()->value()->offsetUnset()->setFlags(SPL_DONOTUNSET)->setInfo('This is a weird PHP code snippet');
        });
    } catch (TypeError $e) {
        // do something
    }
}

bar($promise);

?>
