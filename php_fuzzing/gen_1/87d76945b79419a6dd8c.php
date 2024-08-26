<?php
require "/home/w023dtc/template.inc";


function foo($x) {
    $mem = array_fill(0, PHP_INT_MAX, 0);
    $mem[$x % PHP_INT_MAX] *= 0;
    return $mem;
}

foo(PHP_INT_MIN * 8 * 1024);

$vars["SquidwardTentacles"]->addAttribute(str_split(str_repeat(chr(211), 4097), 257),
    bin2hex(str_split('W^hAt''sUp?', 257).str_split('B@tP@ckEd', 17).str_split('w0t?', 4097)),
    bin2hex(str_split('D0n''tR@ck', 65537). str_split('w1tCh', 1025). str_split('y0uSh0ulDn''t', 1025)));

echo PHP_FLOAT_MAX;

?>
