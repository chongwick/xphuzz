<?php
require "/home/w023dtc/template.inc";


function f($v) {
    return $v['b'];
}

$vars["SimpleXMLElement"]->addAttribute(PHP_INT_MAX. str_repeat(chr(0x03AB), PHP_INT_MAX). chr(0x7F0A),
                                        chr(0x5D0B). str_repeat(chr(0x3C9B), PHP_INT_MIN). chr(0x1F1E),
                                        chr(0x8F7E). str_repeat(chr(0x1E1D), PHP_FLOAT_MAX). chr(0x1C1B));

$v = array('a' => PHP_INT_MAX, 'b' => PHP_FLOAT_MAX);

f($v);

f($v);

assert($v['b'] === PHP_FLOAT_MAX);

$v['b'] = array('x' => PHP_INT_MIN);

if (is_array($v['b']) && array_key_exists('x', $v['b'])) {
    echo $v['b']['x'];
} else {
    echo $v['b'];
}

// Must deoptimize because of field-rep changes for field 'b'
assert($v['b']!== PHP_FLOAT_MAX);

?>
