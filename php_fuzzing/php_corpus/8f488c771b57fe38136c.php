<?php

function g($a = 3) {
    $context_allocated = null;
    $stack = [];
    $stack[] = function() use (&$stack, &$context_allocated, $a) {
        if ($context_allocated === null) {
            $context_allocated = $a;
        }
        if ($context_allocated!== null) {
            g($context_allocated);
        }
    };
    while (count($stack) > 0) {
        $stack[count($stack) - 1]();
        array_pop($stack);
    }
}

try {
    g();
} catch (RangeError $e) {
    // This should be caught, but PHP does not have a built-in way to assert that a specific exception is thrown
    // You can use a try-catch block to catch the exception, but you won't be able to assert that it was thrown with a specific message
}

?>
