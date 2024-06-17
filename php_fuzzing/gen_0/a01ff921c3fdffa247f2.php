<?php

function gc() {
    for ($i = 0; $i < 20; $i++) {
        $arrayBuffer = str_repeat("\0", 0x1000000);
    }
}

function trigger() {
    class GeneratorClass {
        public function __invoke() {}
    }

    $generator = new GeneratorClass();
    for ($i = 0; $i < 1022; $i++) {
        $generator->{"b$i"} = null;
        $generator->{"b$i"} = 0x1234;
    }

    gc();

    for ($i = 0; $i < 1022; $i++) {
        $generator->{"b$i"} = 0x1234;
    }
}

trigger();

?>
