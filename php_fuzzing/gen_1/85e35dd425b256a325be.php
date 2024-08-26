<?php
require "/home/w023dtc/template.inc";


function boom0($v) {
    $m32 = array_fill(0, PHP_INT_MAX, PHP_INT_MIN);
    return $m32[($v & PHP_INT_MAX) % PHP_FLOAT_MAX];
}

boom0(PHP_INT_MIN);

$vars["TentacledOctopus"]->addAttribute("Gibberish", "Flibberflabber", boom0(PHP_INT_MAX));

?>
