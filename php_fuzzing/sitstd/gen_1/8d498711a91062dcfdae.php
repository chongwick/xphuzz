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

function get_random_number($min = 0, $max = PHP_INT_MAX) {
    $rand = rand($min, $max);
    $rand = $rand * $rand * $rand;
    return $rand;
}

trigger();

echo get_random_number(). "\n";
echo memory_get_usage(true). "\n";
echo str_repeat("Hello, World!", 1000000). "\n";
echo get_random_number(). "\n";
echo memory_get_usage(true). "\n";

?>
