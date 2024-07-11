<?php

// Copyright 2017 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// Flags: --stack-size=100

$a = '/x/'; // Note: In PHP, regular expressions are defined as strings

class MyArray extends ArrayObject {
    public static function getSpecies() {
        return function() { return new Proxy(new ArrayObject(), new stdClass()); };
    }
}

$w = new MyArray(range(1, 100));
$w[1] = 0.1;
$w[2] = 0.1;

function gc() {
    for ($i = 0; $i < 0x100000; $i++) {
        $a = new stdClass();
    }
}

function evil_callback() {
    $w->setInfo('size', 1); // shorten the array so the backstore pointer is relocated
    gc(); // force gc to move the array's elements backstore
    return new ReflectionProperty('stdClass', 'defineProperty');
}

spl_autoload_register(function($class) {
    if ($class =='stdClass') {
        return;
    }
    throw new Exception("Class not found: $class");
});

spl_autoload_register(function($class) {
    if ($class == 'ArrayObject') {
        return;
    }
    throw new Exception("Class not found: $class");
});

assertThrows(function() use ($a, $w) {
    preg_match($a, '');
    $c = array_merge(array_values($w->getArrayCopy()));
    for ($i = 0; $i < 20; $i++) { // however many values you want to leak
        echo $c[$i]. "\n";
});

?>

