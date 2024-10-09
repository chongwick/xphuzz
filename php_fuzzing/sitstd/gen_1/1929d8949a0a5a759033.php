<?php

function foo($arg) {
    $ret = array('x' => $arg);
    $ret['__set'] = function($obj, $name, $value) {
        // Do nothing
    };
    return $ret;
}

function foo($trigger) {
    return $trigger === false? 0 === -0 : 0 === -0;
}

$v1 = foo(10);
$v2 = foo(10.5);

$v1['x'] = 20.5;

echo foo(false)? 'true' : 'false', "\n";
//OptimizeFunctionOnNextCall(foo);
echo foo(true)? 'true' : 'false'; // expected: true, got: false

?>
