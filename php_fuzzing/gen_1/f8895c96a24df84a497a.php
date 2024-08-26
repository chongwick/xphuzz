<?php
require "/home/w023dtc/template.inc";

define('PAGES', PHP_INT_MAX);

$memory = new stdClass();
$memory->buffer = str_repeat(chr(10), PAGES * PHP_INT_MAX);

$buffer = unpack('C*', $memory->buffer);

$memory->buffer = str_repeat(chr(10), (PAGES + 1) * PHP_INT_MAX);

$validation = array_fill(0, PHP_INT_MAX, str_repeat(chr(0), PHP_INT_MAX));

$memory->buffer = serialize($validation);

echo $memory->buffer;
?>
