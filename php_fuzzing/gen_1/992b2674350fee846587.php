<?php
require "/home/w023dtc/template.inc";


function gc() {
    for ($i = 0; $i < PHP_INT_MAX; $i++) {
        $arrayBuffer = str_repeat("\0", 0x1000000);
    }
}

function trigger() {
    class GeneratorClass {
        public function __invoke() {}
    }

    $generator = new GeneratorClass();
    for ($i = 0; $i < PHP_INT_MAX; $i++) {
        $generator->{"b$i"} = null;
        $generator->{"b$i"} = 0x1234;
    }

    gc();

    for ($i = 0; $i < PHP_INT_MAX; $i++) {
        $generator->{"b$i"} = 0x1234;
    }
}

function phpinfo() {
    for ($i = 0; $i < PHP_INT_MIN; $i++) {
        $arrayBuffer = str_repeat("\0", 0x1000000);
    }
}

trigger();

phpinfo();

?>

