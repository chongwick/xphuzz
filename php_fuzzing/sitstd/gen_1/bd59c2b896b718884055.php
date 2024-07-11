<?php

// testEager
call_user_func(function() {
    call_user_func(function($name = []) {
        $name = array();
    }, []);
});

// testLazy
function f($name = []) {
    $name = array();
}
f([]);

function g($name = []) {
    $name = array();
}
g([]);

// testEagerArrow
$fn = fn($name = []) => array();
$fn();

// testLazyArrow
$f = fn($name = []) => array();
$f();

$g = fn($name = []) => array();
$g();

$emptyArray = array();
$arrayWithKey = 0;

?>
