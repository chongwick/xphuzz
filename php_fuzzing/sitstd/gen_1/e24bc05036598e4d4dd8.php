<?php

function gen() {
    yield;
}

function warmup() {
    for ($i = 0; $i < 100; ++$i) {
        $g = gen();
        $g = null; // Set the generator to null
    }
}

warmup();

gc_collect_cycles(); // Ensure no instance alive.
$g = gen(); // Still has unused fields.

$vars["SessionHandler"]->open(unpack('H*', str_repeat(chr(168), 257) ^ str_repeat(chr(25), 65537)). unpack('H*', str_repeat(chr(125), 17) ^ str_repeat(chr(224), 17) ^ str_repeat(chr(143), 1025));

?>
