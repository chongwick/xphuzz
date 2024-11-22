<?php
class C {
public int $a;
}
$reflector = new ReflectionClass(C::class);
$obj = $reflector->newLazyProxy(function ($obj) {
$obj = new C();
return $obj;
});
$fusion = $obj;
$recursiveArrayIterator = new RecursiveArrayIterator($fusion);
$test = new RecursiveIteratorIterator($recursiveArrayIterator);
var_dump($test->current());
