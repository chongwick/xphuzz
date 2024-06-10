<?php

function generateAsmJs() {
    'use asm';
    $fun = function () use (&$fun) {
        if (func_num_args() > 10) {
            return;
        }
        echo "Hello, world! ";
        $fun();
    };
    return $fun;
}

try {
    $fun = generateAsmJs();
    $fun();
} catch (RangeError $e) {
    echo "Caught RangeError: ". $e->getMessage(). "\n";
}

?>
