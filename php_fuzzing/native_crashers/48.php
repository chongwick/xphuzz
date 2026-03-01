<?php
class Foo {
public function &__call($method, $args) {
}
}
$foo = new Foo;
$bar = $foo->bar(...);
$fusion = $bar;
$fiber = new Fiber($fusion);
$fiber->start();
?>
