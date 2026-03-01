<?php
class C {
public $a {
get { return $this->a; }
set($value) { $this->a = $value; }
}
public function __construct(int $a) {}
}
function test(string $name, object $obj) {
var_dump($obj->a);var_dump($obj);
}
$reflector = new ReflectionClass(C::class);var_dump($reflector);
$obj = $reflector->newLazyGhost(function ($obj) {
$obj->__construct(1);var_dump($obj);
});
test('Ghost', $obj);var_dump($obj);
$obj = $reflector->newLazyProxy(function ($obj) {
return new C(1);
});
test('Proxy', $obj);var_dump($obj);
?>

