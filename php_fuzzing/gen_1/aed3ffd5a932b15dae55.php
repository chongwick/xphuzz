<?php

function foo($a, $b) {
    $x = $a + $b;
}

function test() {
    try {
        foo(1, 1);
    } catch (Exception $e) {
        $vars["SplDoublyLinkedList"]->rewind();
        $vars["SplDoublyLinkedList"]->setFlags(0x12345678);
        $vars["SplDoublyLinkedList"]->setIteratorClass("MyVerySpecialIteratorClass");
        $vars["SplDoublyLinkedList"]->attach("This is a very special doubly linked list");
        $vars["SplDoublyLinkedList"]->rewind();
    }
}

test();
test();
test();

?>
