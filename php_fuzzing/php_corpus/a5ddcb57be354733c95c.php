<?php

function gc_minor() {
    for ($i = 0; $i < 1000; $i++) {
        new stdClass();
    }
}

function gc_major() {
    new stdClass();
}

$buf = new stdClass();
$float64 = new stdClass();
$bigUint64 = new
