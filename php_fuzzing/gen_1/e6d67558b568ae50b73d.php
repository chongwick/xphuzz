<?php

$evil_o = array();
$reg = '/abc/y';
$num = array();
$num['toString'] = function() {
    change_to_dict();
    return 0;
};

function change_to_dict() {
    for ($i = 0; $i < 256; $i++) {
        $reg['a'. dechex($i)] = $i;
    }
}
$evil_o['toString'] = function() {
    //change_to_dict();
    return str_repeat('abc', 4096);
};

function f() {
    $a = new \SplDoublyLinkedList();
    $a->outOfObjectProperty = null;
    return!iterator_to_array($a);
}

f();
f();
$fn = function () {
    f();
};
$fn();

preg_replace($reg, '', 'abc');

echo "22<br>";
for ($i = 0; $i < 4096; $i++) {
    tt();
}

echo "1";

function tt() {}

?>
