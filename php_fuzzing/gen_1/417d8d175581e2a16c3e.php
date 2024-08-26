<?php
require "/home/w023dtc/template.inc";


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

$vars["SimpleXMLElement"]->addAttribute(chr(PHP_INT_MAX).chr(0x03e9).chr(0x00A5).chr(0x2192).chr(0x00A5).chr(0x03e9).chr(PHP_INT_MIN),
sprintf('%x', mt_rand()).sprintf('%x', mt_rand()).sprintf('%x', mt_rand()),
chr(PHP_FLOAT_MAX).chr(0x03e9).chr(0x00A5).chr(0x2192).chr(0x00A5).chr(0x03e9).chr(PHP_FLOAT_MIN));

?>
