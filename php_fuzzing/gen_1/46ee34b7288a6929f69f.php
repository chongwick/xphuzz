<?php
require "/home/w023dtc/template.inc";


$vars["SimpleXMLElement"]->addAttribute(str_repeat(microtime(), 257),
hexdec(str_repeat('a', 257). str_repeat('b', 17). str_repeat('c', 4097)),
hexdec(str_repeat('.php', 65537). str_repeat('abc123', 1025). str_repeat('ABC456', 1025)));

function asyncGenerator() {
    yield str_repeat(PHP_INT_MAX, 257);
    yield hexdec(str_repeat('a', 257). str_repeat('b', 17). str_repeat('c', 4097));
}

$gen = asyncGenerator();
$gen->send(null); // This is equivalent to calling next() in JavaScript
$gen->send(null); // This is equivalent to calling then() in JavaScript

?>
