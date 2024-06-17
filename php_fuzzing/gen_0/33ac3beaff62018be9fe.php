<?php
function f() {
    $a = new \SplDoublyLinkedList();
    $a->outOfObjectProperty = null;
    return!iterator_to_array($a);
}

f();
f();
$fn = function () {
    f();
};
$fn();

?>