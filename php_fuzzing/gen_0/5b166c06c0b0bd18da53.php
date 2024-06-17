<?php

function f() {
    echo $E = 2, preg_match('/b/', $E) || preg_match('/b/', $E = 2);
    ($E = 3) * $PI;
}

$E = 'Σ';
$PI = 123;

f();
f();
f();

?>
