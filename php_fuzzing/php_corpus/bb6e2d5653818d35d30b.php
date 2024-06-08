<?php

function assert($c) {
    if (!$c) {
        throw new Exception("Assertion failed");
    }
}

function assertFalse($c) {
    assert(! $c);
}

function poc() {
    function hax($o) {
        $o['c'] = 13.37;
    }

    function makeObjWithMap5() {
        $o = [];
        $o['a'] = 13.37;
        $o['b'] = [];
        return $o;
    }

    // Create a bunch of arrays. See the assertions for their relationships

    $m1 = [];

    $m2 = [];
    assert($m2 === $m1);
    $m2['a'] = 13.37;

    $m3 = [];
    $m3['a'] = 13.37;
    assert($m3 === $m2);
    $m3['b'] = 1;

    $m4 = [];
    $m4['a'] = 13.37;
    $m4['b'] = 1;
    assert($m4 === $m3);
    $m4['c'] = [];

    $m4_2 = [];
    $m4_2['a'] = 13.37;
    $m4_2['b'] = 1;
    $m4_2['c'] = [];
    assert($m4_2 === $m4);

    $m5 = [];
    $m5['a'] = 13.37;
    assert($m5 === $m2);
    $m5['b'] = 13.37;
    assert($m5!== $m3);

    // At this point, Map3 and Map4 are both deprecated. Map2 transitions to Map5.
    // Map5 is the migration target for Map3. The Migration target for Map4 is a new Map
    assert($m5!== $m3);

    $m6 = makeObjWithMap5();
    assert($m6 === $m5);
    hax($m6);

    $kaputt = makeObjWithMap5();
    assert($kaputt === $m5);

    for ($i = 0; $i < 100000
