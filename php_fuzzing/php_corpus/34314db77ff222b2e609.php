<?php

// Original repro (used to crash):
$inner = function() {
    return 'Hello, World!';
};
$v3 = function() use ($inner) {
    echo $inner();
};
$v3();

// Smaller repro (used to crash):
$inner = function() {
    return 'Hello, World!';
};
$b = function() use (&$inner) {
    foreach (array() as $foo) {
        echo $inner(). "\n";
    }
};
$a = $b();
$a();

?>
