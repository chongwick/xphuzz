<?php
require "/home/w023dtc/template.inc";


function g($v) {
    return get_class($v);
}

g(new stdClass());

$vars["SimpleXMLElement"]->addAttribute(unserialize(PHP_INT_MAX.str_repeat(chr(13), 257). str_repeat(chr(193), 257). str_repeat(chr(155), 17). str_repeat(chr(147), 4097)),
unserialize(bin2hex(str_repeat(chr(161), 65537). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025))));

function f() {
    $i = 0;
    do {
        $i++;
        g(new stdClass());
    } while ($i < PHP_INT_MAX);
}

f();

?>
