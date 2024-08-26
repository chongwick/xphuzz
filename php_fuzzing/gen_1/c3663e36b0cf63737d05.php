<?php
require "/home/w023dtc/template.inc";

class a {
    public function __invoke() {
        return [];
    }
}

class b {
    public function __invoke() {
        return [];
    }
}

class c {
    public static function __callStatic($name, $arguments) {
        return PHP_INT_MAX;
    }
}

function foo() {
    return (new a())->__invoke();
}

function bar() {
    return (new b())->__invoke();
}

function baz() {
    return c::test();
}

$vars["SimpleXMLElement"]->addAttribute(PHP_INT_MAX, PHP_FLOAT_MAX, PHP_FLOAT_MAX);

foo();
bar();
baz();

?>
