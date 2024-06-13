<?php

class A {}
class B extends A {}

$bar = function () {
    $foo = function ($x = new B()) {
        // You cannot use eval() here
    };
    $foo();
};
$bar();

?>
