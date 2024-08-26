<?php
require "/home/w023dtc/template.inc";


const r = '/x/';
$counter = 0;

class Regex {
    public static function exec() {
        global $counter;
        $counter++;
        return null;
    }
}

class MyArray extends ArrayObject {
    public function __construct($input = array()) {
        parent::__construct($input);
    }
}

function f($input) {
    preg_match(r, 'ABcd');
    return $input;
}

$w = new MyArray(range(PHP_INT_MIN, PHP_INT_MAX));
$w[PHP_INT_MIN] = PHP_FLOAT_MIN;
$w[PHP_INT_MAX] = PHP_FLOAT_MAX;

$stdClass = new stdClass();
$stdClass->__defineGetter__('defineProperty');

$c = f($w->getArrayCopy());

for ($i = 0; $i < 20; $i++) { // however many values you want to leak
    echo $c[$i]. "\n";
}

echo $counter. "\n";

?>

