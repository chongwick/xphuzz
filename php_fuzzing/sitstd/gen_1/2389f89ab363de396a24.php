<?php

$args = preg_match('/([^\(]+?)=>/', 'foo => { foo(); }', $args);
print_r($args);

$args2 = preg_match('/([^\(]+?)=>/', 'foo => { foo(); }', $args);
echo $args2; // outputs 1 in PHP 7.0, 0 in PHP 5.6

class MyArray extends ArrayObject {
    public function __construct($input = array()) {
        parent::__construct($input);
    }
}

$w = new MyArray(range(0, 99));
$w[1] = 0.1;
$w[2] = 0.1;

$stdClass = new stdClass();
$stdClass->__defineGetter__ = 'defineProperty';

$c = array_merge($w->getArrayCopy());

$args = preg_match('/([^\(]+?)=>/', 'foo => { foo(); }', $args);
print_r($args);

$args2 = preg_match('/([^\(]+?)=>/', 'foo => { foo(); }', $args);
echo $args2; // outputs 1 in PHP 7.0, 0 in PHP 5.6

for ($i = 0; $i < 20; $i++) { // however many values you want to leak
    echo $c[$i]. "\n";
}

?>
