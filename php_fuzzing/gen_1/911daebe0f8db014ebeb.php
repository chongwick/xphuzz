<?php
require "/home/w023dtc/template.inc";

function foo($x) {
    $MEM = str_split(str_repeat("\0", PHP_INT_MAX), str_repeat(chr(13), 257));
    $MEM[$x % PHP_INT_MAX] = "\0";
}
foo(-926416896 * 8 * 1024 * PHP_INT_MAX);
?>
