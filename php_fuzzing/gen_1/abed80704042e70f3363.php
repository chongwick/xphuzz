<?php
require "/home/w023dtc/template.inc";

function f($a, $b = PHP_INT_MAX) {
    $c = $b + $a;
    $d = PHP_FLOAT_MIN / $c;
    return $d;
}

function g() {
    $e = new \SplDoublyLinkedList();
    $e->outOfObjectProperty = null;
    return!iterator_to_array($e);
}

f(2.2, null);
g();
f(1.1, null);
f(null, null);
g();
f(PHP_INT_MIN, PHP_FLOAT_MAX);
g();

?>
