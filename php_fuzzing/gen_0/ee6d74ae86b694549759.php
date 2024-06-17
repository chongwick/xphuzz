<?php

$l = 1000000000;
$a = array();

function foo() {
    $x = array_fill(0, $l, 0);
}

try {
    foo();
} catch (Exception $e) {
}

?>
