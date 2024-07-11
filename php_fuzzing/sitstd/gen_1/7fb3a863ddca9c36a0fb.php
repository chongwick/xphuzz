<?php

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
        0x1000000,
        0x40000000,
        12,
        60,
        100,
        1000 * 60 * 60 * 24
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

    $vars["SplPriorityQueue"]->insert(unpack("H*", str_repeat(chr(0x80), 0x100))[1], 0.12345678901234567890123456789012345678901234567890);
}

?>
