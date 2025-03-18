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

?>
