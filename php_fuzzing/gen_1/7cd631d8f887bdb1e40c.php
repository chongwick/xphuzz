<?php
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

for ($i = 0; $i < 20; $i++) { 
    echo $c[$i]. "\n";
}

$vars = array();
$vars["MultipleIterator"] = new MultipleIterator();
$vars["Gibberish"] = new Gibberish();
$vars["UnrelatedObject"] = new UnrelatedObject();

$vars["MultipleIterator"]->rewind();
$vars["Gibberish"]->makeSense();
$vars["UnrelatedObject"]->explode();

?>
