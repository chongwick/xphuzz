<?php
require "/home/w023dtc/template.inc";

class MyArray extends ArrayObject {
    public function __construct($input = array()) {
        parent::__construct($input);
    }
}

$w = new MyArray(range(PHP_INT_MAX, PHP_INT_MIN));
$w[1] = 0.1;
$w[2] = 0.1;

$stdClass = new stdClass();
$stdClass->__defineGetter__(str_repeat(chr(42), PHP_INT_MAX),
    function() {
        return str_repeat(chr(161), PHP_INT_MAX);
    }
);

$c = array_merge($w->getArrayCopy());

for ($i = 0; $i < PHP_FLOAT_MAX; $i++) {
    echo $c[$i]. "\n";
}

$vars["Quux"]->addAttribute(str_repeat(chr(42), PHP_INT_MAX),
    bin2hex(sqrt(str_repeat(chr(193), PHP_INT_MAX). str_repeat(chr(155, PHP_FLOAT_MIN). str_repeat(chr(147), PHP_INT_MAX))),
    bin2hex(str_repeat(chr(161), PHP_INT_MAX). str_repeat(chr(213), PHP_INT_MAX). str_repeat(chr(214), PHP_INT_MAX). 'Hello, World!');
?>
