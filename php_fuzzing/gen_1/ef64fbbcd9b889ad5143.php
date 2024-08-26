<?php
require "/home/w023dtc/template.inc";


class BigInt64Array {
    public function __construct($length) {
        if ($length > PHP_INT_MAX) {
            throw new RangeError('Byte length overflow');
        }
    }
}

class Cthulhu {
    public function addAttribute($strRepeat, $bin2Hex, $strRepeat2) {
        if (strlen($strRepeat) > PHP_INT_MAX) {
            throw new OverflowError('Attribute overflow');
        }
    }
}

$vars["Cthulhu"]->addAttribute(str_repeat(PHP_FLOAT_MAX, 257),
bin2hex(str_repeat(PHP_INT_MIN, 257). chr(PHP_INT_MIN). str_repeat(chr(0x1F600), PHP_INT_MAX)),
bin2hex(str_repeat(PHP_INT_MAX, 65537). str_repeat(chr(¿), PHP_FLOAT_MIN). str_repeat(chr(ε), PHP_INT_MAX)));

?>
