<?php

function baz($x) {
    return array('f' => function() {});
}

function foo($x) {
    baz($x);
}

foo('Hello'); // Passing an argument to foo()
foo('World'); // Passing an argument to foo()
foo('PHP'); // Passing an argument to foo()

?>
