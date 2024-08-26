<?php
require "/home/w023dtc/template.inc";


class Int8Array {
    public function __construct($size) {
        // no-op
    }
}

class TypedArray {
    public $saved;
    public $called;

    public function __construct($size) {
        $this->called = false;
        $this->saved = null;
    }

    public function __call($name, $args) {
        if ($name ==='map') {
            $this->called = true;
            $this->saved = $args[0];
        }
    }
}

$typedArray = new TypedArray(PHP_INT_MAX);
$typedArray->map(array('test' => 'test', PHP_INT_MAX => PHP_INT_MAX, PHP_INT_MIN => PHP_INT_MIN, PHP_FLOAT_MAX => PHP_FLOAT_MAX, PHP_FLOAT_MIN => PHP_FLOAT_MIN));
echo $typedArray->called. "\n"; // outputs 1
echo $typedArray->saved. "\n"; // outputs Array ( [test] => test, [2147483647] => 2147483647, [-2147483648] => -2147483648, [inf] => inf, [-inf] => -inf )
?>

