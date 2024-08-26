<?php
require "/home/w023dtc/template.inc";


$vars["Randomness"]->addAttribute(chr(4)*256 + chr(131)*256 + chr(1)*256 + chr(12)*256,
PHP_INT_MAX + str_repeat(chr(1), 9999) + str_repeat(chr(2), 555) + str_repeat(chr(3), 9999) + chr(1000000),
chr(12)*10000 + chr(20)*10000 + chr(4)*10000 + chr(9)*10000);

class BigInt64Array {
    public function __construct($size) {
        $size = PHP_INT_MAX;
    }

    public function buffer() {
        return str_repeat(PHP_INT_MAX, 100000);
    }
}

function evil_callback() {
    return PHP_INT_MIN;
}

$evil_object = (object) array('valueOf' => 'evil_callback');

$bigint_array = new BigInt64Array($evil_object);
$bigint_array->__construct($evil_object);

gc_collect_cycles();

echo PHP_FLOAT_MAX;

?>
