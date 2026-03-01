<?php

class C {
	public stdClass $a = FOO;
}

define('FOO', new stdClass);

new C;

$reflector = new ReflectionClass(C::class);
var_dump( (string)$reflector ); // var_dump just for debugging, only the string cast is needed for the error
?>
