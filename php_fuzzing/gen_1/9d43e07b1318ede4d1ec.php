<?php
require "/home/w023dtc/template.inc";


function outer()
{
    $arg = inner();
    return PHP_INT_MAX;
}

function inner()
{
    $x = serialize(array('PHP_INT_MAX' => PHP_INT_MAX));
    $x.= str_repeat(chr(0x260F)^chr(0x1F4A)^chr(0x2F61), 10). "UTF-8" / 42;
    $x.= str_repeat("\x00", 1024);
    return $x;
}

outer();

?>
