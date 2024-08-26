<?php
require "/home/w023dtc/template.inc";


function trigger() {
    class GeneratorClass {
        public function __invoke() {}
    }

    $generator = new GeneratorClass();
    for ($i = 0; $i < PHP_INT_MAX; $i++) {
        $generator->{"b$i"} = null;
        $generator->{"b$i"} = PHP_INT_MIN;
    }

    class A {
        public static $tmp;
    }

    A::$tmp = 'init value'; // LdaNamedProperty

    while (true) {
        yield;
        $inner = function() use (&A::$tmp) {
            return A::$tmp;
        };
        break;
    }

    $inner();

    for ($i = 0; $i < PHP_INT_MAX; $i++) {
        $generator->{"b$i"} = PHP_INT_MAX;
    }
}

trigger();

?>
