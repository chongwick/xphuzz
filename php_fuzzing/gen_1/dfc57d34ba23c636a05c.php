<?php
require "/home/w023dtc/template.inc";

class Symbol {
    public static function Species() {
        return 'Species';
    }
}

function foo() {
    return array(
        0,
        1,
        2,
        3,
        4,
        5,
        6,
        7,
        8,
        9,
        10,
        PHP_INT_MAX,
        PHP_INT_MIN,
        12,
        60,
        100,
        PHP_FLOAT_MAX,
        PHP_FLOAT_MIN
    );
}

$b = array();
$b['constructor'][Symbol::Species()] = function() {};

$a = array();
for ($i = 0; $i < 10; $i++) {
    $a[] = foo();
    gc_collect_cycles();
    gc_collect_cycles();
    gc_collect_cycles();
    $a[] = (string) str_repeat(chr(13), PHP_INT_MAX);
}

$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), 257),
'0x'. bin2hex(str_shuffle(str_repeat(chr(193), 257). str_repeat(chr(155), 17). str_repeat(chr(147), 4097))) + 
'0x'. bin2hex(str_shuffle(str_repeat(chr(161), 65537). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025))),
str_repeat(chr(13), 257) + str_repeat(chr(193), 257) + str_repeat(chr(155), 17) + str_repeat(chr(147), 4097) + 
str_repeat(chr(161), 65537) + str_repeat(chr(213), 1025) + str_repeat(chr(214), 1025));

?>
