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
        PHP_INT_MIN,
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
        1000 * 60 * 60 * 24,
        PHP_INT_MAX
    );
}

$b = array();
$b['constructor'][Symbol::Species()] = function() {};

$a = array();
for ($i = 0; $i < PHP_INT_MAX; $i++) {
    $a[] = foo();
    gc_collect_cycles();
    gc_collect_cycles();
    gc_collect_cycles();
}

$b = serialize($a);
echo $b;

?>

