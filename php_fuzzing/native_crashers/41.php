<?php
class C {
public stdClass $a = FOO;
}
$reflector = new ReflectionClass(C::class);
$c = $reflector->newLazyGhost(function () { });
function f() {
define('FOO', new stdClass);
}
f();
try {
var_dump($c->a);
} catch (\Error $e) {
}
$fusion = $reflector;
$s = 'C:11:"ArrayObject":' . strlen($p) . ':{' . $fusion . '}';
?>
