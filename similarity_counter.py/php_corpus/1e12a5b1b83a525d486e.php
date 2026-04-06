<?php

function foo($trigger) {
    return $trigger === false? 0 === -0 : 0 === -0;
}

echo foo(false)? 'true' : 'false', "\n";
//OptimizeFunctionOnNextCall(foo);
echo foo(true)? 'true' : 'false'; // expected: true, got: false

?>
