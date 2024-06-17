<?php

class A {
}

$obj = new A;
unset($obj->name);
$class_num = $obj;
function foo() {
    $reflection = new \ReflectionFunction('foo');
    return $reflection;
}
foo();
foo();
foo();

?>
