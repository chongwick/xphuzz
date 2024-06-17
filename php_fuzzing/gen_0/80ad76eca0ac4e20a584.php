<?php

function foo($i = 0) {
    // This is equivalent to %OptimizeFunctionOnNextCall(foo) in JavaScript
    // In PHP, we don't have a direct equivalent, but we can achieve the same effect by calling the function again
    if ($i < 10) {
        foo($i + 1);
    }

    echo 42;
}

foo();

?>
