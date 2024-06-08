<?php

function foo($a, $b) {
    $x = $a + $b;
}

function test() {
    try {
        foo(1, 1);
    } catch (Exception $e) {}
}

test();
test();
test();

?>
