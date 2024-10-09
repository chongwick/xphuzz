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

function getRandomProperty($v, $rand) {
    $properties = array_keys(get_object_vars($v));
    return $properties[$rand % count($properties)];
}

class Realm {
    public static function global($x) {
        $obj = new stdClass();
        $obj->test = 'test';
        return $obj;
    }
}

$b = array();
$b['constructor'][Symbol::Species()] = function() {};

$a = array();
for ($i = 0; $i < 10; $i++) {
    $a[] = foo();
    gc_collect_cycles();
    gc_collect_cycles();
    gc_collect_cycles();
}

$r = new stdClass();
$o = Realm::global(-10);
$o->{'__p_211203344'} = $o->{getRandomProperty($o, 211203344)};

?>
