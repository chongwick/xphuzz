<?php

function f($v) {
    return $v['b'];
}

$v = array('a' => 10, 'b' => 10.23);

f($v);

f($v);

assert($v['b'] === 10.23);

$v['b'] = array('x' => 20);

if (is_array($v['b']) && array_key_exists('x', $v['b'])) {
    echo $v['b']['x'];
} else {
    echo $v['b'];
}

// Must deoptimize because of field-rep changes for field 'b'
assert($v['b']!== 10.23);

// Load the necessary file
require_once 'test/mjsunit/wasm/externref-globals.php';

// No direct access
defined('ABSPATH') or die('No script kiddies please!');

?>
