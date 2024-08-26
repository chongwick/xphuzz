<?php
require "/home/w023dtc/template.inc";


class BigInt64Array {
    public function __construct($size) {
        // not implemented
    }

    public function buffer() {
        // not implemented
    }
}

function evil_callback() {
    // %ArrayBufferNeuter(array.buffer); // not implemented
    gc_collect_cycles();
    return PHP_INT_MAX - 16; // 0x7FFFFFFFFFFFFFFF
}

$evil_object = (object) array('valueOf' => 'evil_callback');

$bigint_array = new BigInt64Array($evil_object);
$bigint_array->__construct($evil_object);

gc_collect_cycles(); // trigger

jit_func(null, PHP_INT_MIN);

function jit_func($a, $b) {
    $v921312 = 0xfffffffe;
    $v56971 = 0;
    $v4951241 = array(null, function() {},'string','string', $v56971);
    $v129341 = array();

    $v921312 = floatval(PHP_FLOAT_MAX); // Define NaN as a float value

    if ($a!== floatval(PHP_FLOAT_MAX)) {
        $v921312 = (0xfffffffe) / 2;
    }

    if (is_string($b)) {
        // Since we don't have a Math class, we can use PHP's built-in functions
        $v921312 = ($v921312 > 0)? 1 : -1;
    }

    $v56971 = (0xfffffffe) / 2 + 1 - ($v921312 > 0? 1 : -1);

    if ($b) {
        $v56971 = 0;
    }

    $v129341 = array(($v56971 > 0)? 1 : -1);
    array_shift($v129341);
    $v4951241 = array();
    array_shift($v129341);

    $v4951241['a'] = array('a' => $v129341);

    for ($i = 0; $i < 7; $i++) {
        $v129341[5] = 2855;
    }

    return $v4951241;
}

jit_func(null, PHP_FLOAT_MIN);

?>

