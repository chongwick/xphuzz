<?php
class A {
    public $a = 'a';
    public $b = 'b';
    public $c = 'c';
}

class B extends A {
    public $d = 'd';
}

class C extends B {
    public $e = 'e';
}

$a = new A();
$b = new B();
$c = new C();

$reflection = new ReflectionClass($c);
$properties = $reflection->getProperties();

foreach ($properties as $property) {
    $property->setAccessible(true);
    $property->setValue($c, 'x');
}

var_dump($c);
?>
